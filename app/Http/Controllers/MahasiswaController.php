<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\ProgramOption;
use App\Models\PersonalData;
use App\Models\Education;
use App\Models\Address;
use App\Models\Family;
use App\Models\Income;
use App\Models\Referal;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $students = User::where('role', 'Customer')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
                });
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('admin.mahasiswa.index', compact('students', 'search', 'startDate', 'endDate'));
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
        $user = User::find($id);
        $referals = Referal::all();

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $personalData = PersonalData::where('user_id', $user->id)->first();
        $education = Education::where('user_id', $user->id)->first();
        $address = Address::where('user_id', $user->id)->first();
        $income = Income::where('user_id', $user->id)->first();
        $families = Family::where('user_id', $user->id)->get();

        return view('admin.mahasiswa.show', compact(
            'user', 'personalData', 'education', 'address', 'income', 'families', 'referals'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = $request->has('unverify') ? null : now();
        $user->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status berhasil diperbarui!');
    }
    
    public function updateReferal(Request $request, string $id)
    {
        $validated = $request->validate([
            'referal_id' => 'nullable|integer',
        ]);

        // Cari data berdasarkan ID
        $personalData = PersonalData::findOrFail($id);

        // Update data menggunakan mass assignment
        $personalData->update($validated);

        // Redirect atau response JSON
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
