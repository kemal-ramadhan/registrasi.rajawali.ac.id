<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Faculty;

use Illuminate\Support\Facades\Storage;

class DepartementReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $departements = Departement::with('faculty')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('status', 'like', "%$search%")
                            ->orWhereHas('faculty', function ($q) use ($search) {
                                $q->where('name', 'like', "%$search%");
                            });
            })
            ->paginate(10);

        return view('admin.departement.index', compact('departements', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Faculty::all();
        return view('admin.departement.create', compact('fakultas'));
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
            'faculty_id' => 'required',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images-internal', 'public'); 
        } else {
            $filePath = null;
        }

        // Simpan data ke database
        Departement::create([
            'code'       => $request->code,
            'faculty_id'       => $request->faculty_id,
            'name'       => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $filePath, // Simpan path ke database
        ]);

        return redirect()->route('departement.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departement = Departement::findOrFail($id);
        $fakultas = Faculty::all();
        return view('admin.departement.edit', compact('departement', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code'=> 'required',
            'name'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'required',
            'faculty_id' => 'required',
        ]); 
    
        // Temukan data lama
        $departement = Departement::findOrFail($id);
        $filePath = $departement->image; // Simpan path gambar lama
    
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
        $departement->update([
            'code'       => $request->code,
            'faculty_id'       => $request->faculty_id,
            'name'       => $request->name,
            'description' => $request->description,
            'status'      => $request->status, 
            'image'       => $filePath, // Simpan path baru jika ada, tetap gunakan yang lama jika tidak diganti
        ]);
    
        return redirect()->route('departement.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Departement::findOrFail($id)->delete();
        return redirect()->route('departement.index')->with('success', 'Data berhasil dihapus.');
    }
}
