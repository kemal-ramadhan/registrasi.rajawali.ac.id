<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PaymantMethod;
use App\Models\PaymantMethodKategori;
use Illuminate\Support\Facades\Storage;

class MetodePaymantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $methods = PaymantMethod::with('paymantKategori')
            ->when($search, function ($query, $search) {
                return $query->where('metode', 'like', "%$search%")
                            ->orWhere('methode_initial', 'like', "%$search%")
                            ->orWhere('status', 'like', "%$search%")
                            ->orWhereHas('paymantKategori', function ($q) use ($search) {
                                $q->where('name', 'like', "%$search%");
                            });
            })
            ->paginate(10);
        
        return view('admin.metode.index', compact('methods', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = PaymantMethodKategori::all();
        return view('admin.metode.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paymant_method_kategori_id' => 'required',
            'methode' => 'required',
            'biaya_admin' => 'required',            
            'methode_initial' => 'required',            
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
        PaymantMethod::create([
            'paymant_method_kategori_id'       => $request->paymant_method_kategori_id,
            'methode'       => $request->methode,
            'biaya_admin' => $request->biaya_admin,
            'methode_initial' => $request->methode_initial,
            'image'       => $filePath, // Simpan path ke database
            'status'      => $request->status,  
        ]);

        return redirect()->route('metode.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }
    
    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ]);

        // Simpan data ke database
        PaymantMethodKategori::create([
            'name'       => $request->kategori,
            'status'      => 'active',
        ]);

        return redirect()->route('metode.index')->with('success', 'Kategori berhasil ditambahkan.');
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
        $method = PaymantMethod::findOrFail($id);
        $kategoris = PaymantMethodKategori::all();
        return view('admin.metode.edit', compact('kategoris', 'method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'paymant_method_kategori_id' => 'required',
            'methode' => 'required',
            'methode_initial' => 'required',            
            'biaya_admin' => 'required',            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ]);

        // Temukan data metode pembayaran berdasarkan ID
        $method = PaymantMethod::findOrFail($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan gambar baru ke storage
            $filePath = $request->file('image')->store('images-internal', 'public');

            // Hapus gambar lama jika ada
            if ($method->image && Storage::disk('public')->exists($method->image)) {
                Storage::disk('public')->delete($method->image);
            }
        } else {
            // Gunakan gambar lama jika tidak ada gambar baru
            $filePath = $method->image;
        }

        // Update data ke database
        $method->update([
            'paymant_method_kategori_id' => $request->paymant_method_kategori_id,
            'methode' => $request->methode,
            'methode_initial' => $request->methode_initial,
            'biaya_admin' => $request->biaya_admin,
            'image' => $filePath,
            'status' => $request->status,
        ]);

        return redirect()->route('metode.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PaymantMethod::findOrFail($id)->delete();
        return redirect()->route('metode.index')->with('success', 'Data berhasil dihapus.');
    }
}
