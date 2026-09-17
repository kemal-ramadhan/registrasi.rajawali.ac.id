<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RegistrationTest;
use App\Models\RegistrationPath;

use Illuminate\Support\Facades\Storage;

class RegistrationTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tests = RegistrationTest::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%") // Bisa cari juga di deskripsi
                ->orWhere('status', 'like', "%$search%"); // Status juga bisa dicari
        })
            ->orderBy('created_at', 'desc') // Menampilkan data terbaru terlebih dahulu
            ->paginate(10);

        return view('admin.test.index', compact('tests', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registrations = RegistrationPath::all();
        return view('admin.test.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'registration_path_id' => 'required|exists:registration_paths,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validasi gambar
            'link_grup' => 'nullable|url',
            'status' => 'required|string|in:active,non-active', // Status bisa aktif atau non-aktif
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images-internal', 'public');
        } else {
            $imagePath = null;
        }

        // Menyimpan data ke dalam tabel registration_tests
        $registrationTest = RegistrationTest::create([
            'registration_path_id' => $validatedData['registration_path_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'image' => $imagePath,
            'link_grup' => $validatedData['link_grup'],
            'status' => $validatedData['status'],
        ]);

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('registration-test.index')->with('success', 'Registration Test successfully created!');
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
    public function edit($id)
    {
        // Ambil data yang akan diedit
        $registrationTest = RegistrationTest::findOrFail($id);
        
        // Ambil semua registration paths untuk dropdown
        $registrations = RegistrationPath::all();

        return view('admin.test.edit', compact('registrationTest', 'registrations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'registration_path_id' => 'required|exists:registration_paths,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,non-active',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'link_grup' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $registrationTest = RegistrationTest::findOrFail($id);

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($registrationTest->image && Storage::exists('public/' . $registrationTest->image)) {
                Storage::delete('public/' . $registrationTest->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update data
        $registrationTest->update($validatedData);

        return redirect()->route('registration-test.index')->with('success', 'Registration Test updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RegistrationTest::findOrFail($id)->delete();
        return redirect()->route('registration-test.index')->with('success', 'Data berhasil dihapus.');
    }
}
