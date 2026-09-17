<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\ProgramLevel;

use Illuminate\Support\Facades\Storage;
use SebastianBergmann\FileIterator\Facade;

class FakultasReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $fakultys = Faculty::with('programLevel')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('status', 'like', "%$search%")
                            ->orWhereHas('programLevel', function ($q) use ($search) {
                                $q->where('title', 'like', "%$search%");
                            });
            })
            ->paginate(10);
        
        return view('admin.fakultas.index', compact('fakultys', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programLevels = ProgramLevel::all();
        return view('admin.fakultas.create', compact('programLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'program_level_id' => 'required',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images-internal', 'public'); 
        } else {
            $filePath = null;
        }

        // Simpan data ke database
        Faculty::create([
            'code'       => $request->code,
            'program_level_id'       => $request->program_level_id,
            'name'       => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $filePath, // Simpan path ke database
        ]);

        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fakultas = Faculty::findOrFail($id);
        $programLevels = ProgramLevel::all();
        return view('admin.fakultas.edit', compact('fakultas', 'programLevels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fakultas = Faculty::findOrFail($id);
        $programLevels = ProgramLevel::all();
        return view('admin.fakultas.edit', compact('fakultas', 'programLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code'      => 'required',
            'name'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'required',
            'program_level_id' => 'required',
        ]); 
    
        // Temukan data lama
        $fakultas = Faculty::findOrFail($id);
        $filePath = $fakultas->image; // Simpan path gambar lama
    
        // Jika ada file baru di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
    
            // Simpan file baru
            $filePath = $request->file('image')->store('images-internal', 'public');
        }
    
        // Update data di database
        $fakultas->update([
            'code'      => $request->code,
            'program_level_id'       => $request->program_level_id,
            'name'       => $request->name,
            'description' => $request->description,
            'status'      => $request->status, 
            'image'       => $filePath, // Simpan path baru jika ada, tetap gunakan yang lama jika tidak diganti
        ]);
    
        return redirect()->route('fakultas.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faculty::findOrFail($id)->delete();
        return redirect()->route('fakultas.index')->with('success', 'Data berhasil dihapus.');
    }
}
