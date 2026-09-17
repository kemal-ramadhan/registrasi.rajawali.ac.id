<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Biaya;
use App\Models\Detail_scema_cicilan;
use App\Models\Scema_cicilan;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Biaya::query();

        // Search berdasarkan deskripsi atau tipe
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        $biayas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.biaya.index', compact('biayas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.biaya.create');
    }
    public function createScema($id)
    {
        return view('admin.biaya.scema', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'biaya' => 'required|string|max:255',
            'description' => 'nullable|string',
            'nominal' => 'required|numeric|min:0',
            'type' => 'required|in:Tunai,Angsuran', // sesuaikan pilihan type
            'tengat_akhir' => 'nullable|date',
            'status' => 'required', // sesuaikan dengan status yang kamu pakai
        ]);

        // Simpan ke database
        $biaya = Biaya::create($validated);

        return redirect()->route('biayareferensi.index')->with('success', 'Data Pembayaran berhasil tambah.');
    }

    public function storeScema(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'biaya_id' => 'required|exists:biayas,id', // pastikan tabel 'biayas' benar
            'description' => 'nullable|string',
            'potongan' => 'required|numeric|min:0',
            'jumlah_cicilan' => 'required|integer|min:1',
            'status' => 'required|in:Publish,Draf', // sesuaikan dengan status yang berlaku
        ]);


        // Simpan ke database
        Scema_cicilan::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('biayareferensi.show', $validated['biaya_id'])->with('success', 'Skema angsuran berhasil ditambahkan.');
    }

    public function storeDetailScema(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'scema_cicilan_id' => 'required|integer|exists:scema_cicilans,id',
            'cicilan_ke' => 'required|integer|min:1',
            'nominal' => 'required|numeric|min:0',
            'tengat' => 'required|date',
        ]);

        // Simpan data
        Detail_scema_cicilan::create($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data cicilan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $biaya = Biaya::findOrFail($id);
        $scema_cicilans = Scema_cicilan::where('biaya_id', $id)->get();
        return view('admin.biaya.show', compact('biaya', 'scema_cicilans'));
    }

    public function showScema(string $id)
    {
        $scema = Scema_cicilan::find($id);
        $biaya = Biaya::find($scema->biaya_id);
        $details = Detail_scema_cicilan::where('scema_cicilan_id', $id)->get();
        $totalNominal = Detail_scema_cicilan::where('scema_cicilan_id', $id)->sum('nominal');
        return view('admin.biaya.detail', compact('biaya', 'scema', 'details', 'totalNominal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $biaya = Biaya::findOrFail($id);
        return view('admin.biaya.edit', compact('biaya'));
    }

    public function editScema(string $id)
    {
        $scema = Scema_cicilan::findOrFail($id);
        return view('admin.biaya.editScema', compact('scema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'biaya' => 'required|string|max:255',
            'description' => 'nullable|string',
            'nominal' => 'required|numeric|min:0',
            'type' => 'required|in:Tunai,Angsuran', // sesuaikan pilihan type
            'tengat_akhir' => 'nullable|date',
            'status' => 'required', // sesuaikan dengan status yang kamu pakai
        ]);

        // Temukan data berdasarkan ID
        $biaya = Biaya::findOrFail($id);

        // Update data
        $biaya->update($validated);

        return redirect()->route('biayareferensi.show', $id)->with('success', 'Data Pembayaran berhasil diperbarui.');
    }

    public function updateScema(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'biaya_id' => 'required|exists:biayas,id',
            'description' => 'nullable|string',
            'potongan' => 'required|numeric|min:0',
            'jumlah_cicilan' => 'required|integer|min:1',
            'status' => 'required|in:Publish,Draf',
        ]);

        // Cari data berdasarkan ID
        $scema = Scema_cicilan::findOrFail($id);

        // Update data
        $scema->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('biaya.scema.detail', $id)
            ->with('success', 'Skema angsuran berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $biaya = Biaya::findOrFail($id);
        $biaya->delete();

        return redirect()->route('biayareferensi.index')->with('success', 'Data Pembayaran berhasil dihapus.');
    }
    
    public function destroyDetail($id)
    {
        $detail = Detail_scema_cicilan::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
