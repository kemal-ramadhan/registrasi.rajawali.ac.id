<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramLevel;
use Illuminate\Support\Facades\Storage;


class ReferensiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $jenjangs = ProgramLevel::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                         ->orWhere('code', 'like', "%$search%")
                         ->orWhere('description', 'like', "%$search%")
                         ->orWhere('status', 'like', "%$search%");
        })->paginate(10);
        
        return view('admin.jenjang.index', compact('jenjangs', 'search'));
    }

    public function create()
    {
        return view('admin.jenjang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images-internal', 'public'); 
        } else {
            $filePath = null;
        }

        // Simpan data ke database
        ProgramLevel::create([
            'code'=> $request->code,
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content,
            'status'      => $request->status,
            'image'       => $filePath, // Simpan path ke database
        ]);

        return redirect()->route('referensi.jenjang')->with('success', 'Jenjang Program berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenjang = ProgramLevel::findOrFail($id);
        return view('admin.jenjang.edit', compact('jenjang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code'=> 'required',
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'required',
        ]); 

        // Temukan data lama
        $programLevel = ProgramLevel::findOrFail($id);
        $filePath = $programLevel->image; // Simpan path gambar lama

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
        $programLevel->update([
            'code'=> $request->code,
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status, 
            'image'       => $filePath, // Simpan path baru jika ada, tetap gunakan yang lama jika tidak diganti
        ]);

        return redirect()->route('referensi.jenjang')->with('success', 'Jenjang Program berhasil diperbarui.');
    }

    public function destroy($id)
    {
        ProgramLevel::findOrFail($id)->delete();
        return redirect()->route('referensi.jenjang')->with('success', 'Jenjang Program berhasil dihapus.');
    }
}
