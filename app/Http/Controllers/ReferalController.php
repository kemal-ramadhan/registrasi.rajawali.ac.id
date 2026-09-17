<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referal;
use App\Models\User;

class ReferalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $referals = Referal::when($search, function ($query, $search) {
            return $query->where('code', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        })->paginate(10);

        return view('admin.referal.index', compact('referals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereIn('role', ['Customer', 'BK'])->get();
        return view('admin.referal.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'institution' => 'required',
            'code' => 'required',
            'code_pembayaran' => 'required|unique:referals',
            'description' => 'required',
            'status' => 'required',
        ]);


        // Simpan data ke database
        Referal::create([
            'user_id'       => $request->user_id,
            'institution'       => $request->institution,
            'code'       => $request->code,
            'code_pembayaran'       => $request->code_pembayaran,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = 'BK';
        $user->save();

        return redirect()->route('referal.index')->with('success', 'Code Referal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $referal = Referal::with(['personalData.user', 'user'])->findOrFail($id);

        // Jika ada pencarian
        $search = $request->input('search');

        $personalData = $referal->personalData()
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // pagination biar rapi

        return view('admin.referal.show', compact('referal', 'personalData', 'search'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::whereIn('role', ['Customer', 'BK'])->get();
        $referal = Referal::findOrFail($id);
        return view('admin.referal.edit', compact('referal', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Referal $referal)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'institution' => 'required',
            'code' => 'required',
            'code_pembayaran' => 'required|unique:referals',
            'description' => 'required',
            'status' => 'required',
        ]);

        // Update data referal di database
        $referal->update([
            'user_id' => $request->user_id,
            'institution' => $request->institution,
            'code' => $request->code,
            'code_pembayaran' => $request->code_pembayaran,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = 'BK';
        $user->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('referal.index')->with('success', 'Code Referal berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Referal::findOrFail($id)->delete();
        return redirect()->route('referal.index')->with('success', 'Code Referal berhasil dihapus.');
    }
}
