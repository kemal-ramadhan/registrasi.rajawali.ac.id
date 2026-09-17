<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Biaya;
use App\Models\Mahasiswa_paymant;

class PembayaranMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswas = User::when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(50); // bisa disesuaikan

        return view('admin.paymant.index', compact('mahasiswas', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $biayas = Biaya::all();
        $mahasiswa_paymants = Mahasiswa_paymant::where('mahasiswa_id', $mahasiswa->id)->get();
        return view('admin.paymant.show', compact('mahasiswa', 'biayas', 'mahasiswa_paymants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa_paymant = Mahasiswa_paymant::with(['mahasiswa.user', 'biaya'])->findOrFail($id);
        return view('admin.paymant.edit', compact('mahasiswa_paymant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa_paymant = Mahasiswa_paymant::findOrFail($id);
        $mahasiswa_paymant->status = $request->status;
        $mahasiswa_paymant->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
