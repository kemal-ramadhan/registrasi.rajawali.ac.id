<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\RegistrationDepartement;
use App\Models\RegistrationDokumen;
use App\Models\RegistrationPath;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class RegistrationPathReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $registrationPaths = RegistrationPath::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%")
                            ->orWhere('code_year', 'like', "%$search%")
                            ->orWhere('title', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->orWhere('start_date', 'like', "%$search%")
                            ->orWhere('end_date', 'like', "%$search%")
                            ->orWhere('amount', 'like', "%$search%")
                            ->orWhere('status', 'like', "%$search%");
            })->paginate(30);

        return view('admin.registration.index', compact('registrationPaths', 'search'));
    }

    public function indexDocs($id)
    {
        $registration = RegistrationPath::find($id);
        $dokumens = RegistrationDokumen::where('registration_path_id', $id)->get();
        return view('admin.registration.dokumen', compact('registration', 'dokumens'));
    }
    
    public function indexDepartement(Request $request, $id)
    {
        $registration = RegistrationPath::findOrFail($id);
        $departements = Departement::all();

        // Ambil input pencarian
        $search = $request->input('search');

        // Query Departemen yang terkait dengan Registration Path
        $departementsPaginated = Departement::whereHas('registrationPaths', function ($query) use ($id) {
            $query->where('registration_path_id', $id);
        })
        ->with(['registrationPaths' => function ($query) use ($id) {
            $query->where('registration_path_id', $id);
        }])
        ->when($search, function ($query) use ($search) { // Jika ada input search, lakukan pencarian
            $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(10);

        return view('admin.registration.departement', compact('registration', 'departements', 'departementsPaginated', 'search'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.registration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'code_year' => 'required',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
            'link_grup' => 'required',
            'status' => 'required',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images-internal', 'public'); 
        } else {
            $filePath = null;
        }

        // Simpan data ke database
        RegistrationPath::create([
            'code'      => $request->code,
            'code_year' => $request->code_year,
            'name'       => $request->name,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $filePath, // Simpan path ke database
            'start_date'      => $request->start_date,
            'end_date'      => $request->end_date,
            'amount'      => $request->amount,
            'link_grup'      => $request->link_grup,
            'status'      => $request->status,
        ]);

        return redirect()->route('registration.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function storeDocs(Request $request)
    {
        $request->validate([
            'registration_path_id' => 'required',
            'dokumen_name' => 'required',
            'description' => 'required',
        ]);

        RegistrationDokumen::create([
            'registration_path_id' => $request->registration_path_id,
            'dokumen_name' => $request->dokumen_name,
            'slug_name' => $request->dokumen_name,
            'description' => $request->description,
        ]);

        return redirect()->route('registration.indexDocs', $request->registration_path_id)->with('success', 'Data berhasil ditambahkan.');
    }
    
    public function storeDepartement(Request $request)
    {
        $request->validate([
            'registration_path_id' => 'required',
            'departement_id' => 'required',
        ]);

        RegistrationDepartement::create([
            'registration_path_id' => $request->registration_path_id,
            'departement_id' => $request->departement_id,
        ]);

        return redirect()->route('registration.indexDepartement', $request->registration_path_id)->with('success', 'Data berhasil ditambahkan.');
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
        $registrationPath = RegistrationPath::findOrFail($id);
        return view('admin.registration.edit', compact('registrationPath'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required',
            'code_year' => 'required',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
            'link_grup' => 'required',
            'status' => 'required',
        ]); 
    
        // Temukan data lama
        $registration = RegistrationPath::findOrFail($id);
        $filePath = $registration->image; // Simpan path gambar lama
    
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
        $registration->update([
            'code'      => $request->code,
            'code_year' => $request->code_year,
            'name'       => $request->name,
            'title'       => $request->title,
            'description'       => $request->description,
            'image'       => $filePath, // Simpan path baru jika ada, tetap gunakan yang lama jika tidak diganti
            'start_date'       => $request->start_date,
            'end_date'       => $request->end_date,
            'amount'       => $request->amount,
            'link_grup'       => $request->link_grup,
            'status'       => $request->status,
        ]);
    
        return redirect()->route('registration.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RegistrationPath::findOrFail($id)->delete();
        return redirect()->route('registration.index')->with('success', 'Data berhasil dihapus.');
    }
    
    public function destroyDocs(string $id)
    {
        // Ambil data berdasarkan ID
        $regist = RegistrationDokumen::findOrFail($id);
        
        // Simpan registration_path_id sebelum menghapus
        $registrationPathId = $regist->registration_path_id;

        // Hapus data
        $regist->delete();

        // Redirect dengan membawa informasi path yang terkait
        return redirect()->route('registration.indexDocs', $registrationPathId)
            ->with('success', 'Data berhasil dihapus.');
    }
    
    public function destroyDepartement(string $id)
    {
        // Ambil data berdasarkan ID
        $regist = RegistrationDepartement::findOrFail($id);
        
        // Simpan registration_path_id sebelum menghapus
        $registrationPathId = $regist->registration_path_id;

        // Hapus data
        $regist->delete();

        // Redirect dengan membawa informasi path yang terkait
        return redirect()->route('registration.indexDepartement', $registrationPathId)
            ->with('success', 'Data berhasil dihapus.');
    }

}
