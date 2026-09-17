<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Jobs\SendWhatsappMessage;

use App\Models\PersonalData;
use App\Models\Education;
use App\Models\Address;
use App\Models\Income;
use App\Models\Family;
use App\Models\Referal;

class PersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referals = Referal::all();
        $personalData = PersonalData::where('user_id', Auth::id())->first();
        return view('customer.data.index', compact('personalData', 'referals'));
    }
    public function indexPendidikan()
    {
        $personalData = Education::where('user_id', Auth::id())->first();
        return view('customer.data.pendidikan', compact('personalData'));
        return view('customer.data.pendidikan', compact('personalData'));
    }
    public function indexAddress()
    {
        $personalData = Address::where('user_id', Auth::id())->first();
        return view('customer.data.address', compact('personalData'));
    }
    public function indexIncome()
    {
        $personalData = Income::where('user_id', Auth::id())->first();
        return view('customer.data.income', compact('personalData'));
    }

    public function indexFamily()
    {
        // $personalData = Family::where('user_id', Auth::id())->first();
        $personalData = Family::where('user_id', Auth::id())->skip(0)->first();
        $personalData_2 = Family::where('user_id', Auth::id())->skip(1)->first();

        return view('customer.data.family', compact('personalData', 'personalData_2'));
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
    public function storeFotoProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'profile' => 'required|image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $user = Auth::user();

        // Upload foto ke storage/app/public/profiles
        $path = $request->file('profile')->store('profiles', 'public');

        // Hapus foto lama kalau ada
        if ($user->profile && Storage::disk('public')->exists($user->profile)) {
            Storage::disk('public')->delete($user->profile);
        }

        // Simpan path ke database
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'profile'  => $path,
            ]);

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . Auth::id(),
            'gander'            => 'required|string|max:20',
            'phone'             => 'required|string|max:15',
            // 'nik'               => 'required|numeric|digits:16|unique:personal_data,nik,' . Auth::id() . ',user_id',
            'nik'               => 'required|numeric|digits:16',
            'nisn'              => 'nullable|numeric|digits_between:10,12',
            'place_of_birth'    => 'required|string|max:100',
            'date_of_birth'     => 'required|date',
            'religion'          => 'required|string|max:50',
            'media_information' => 'required|string|max:50',
            'referal_id' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        PersonalData::updateOrCreate(
            ['user_id' => Auth::id()], // Kondisi pencarian berdasarkan user_id
            [
                'user_id'           => Auth::id(),
                'gander'            => $request->gander, // Pastikan nama kolomnya 'gender' dan bukan 'gander'
                'nik'               => $request->nik,
                'nisn'              => $request->nisn,
                'place_of_birth'    => $request->place_of_birth,
                'date_of_birth'     => $request->date_of_birth,
                'religion'          => $request->religion,
                'media_information' => $request->media_information,
                'referal_id' => $request->referal_id,
            ]
        );


        return redirect()->route('personal.data.pendidikan')->with('success', 'Data Anda berhasil disimpan.');
    }

    public function storeEducation(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'last_education' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'name_of_institution' => 'required|string',
            'departement' => 'required|string|max:255',
            'year_of_graduation' => 'required|integer|digits:4',  // Validasi tahun dengan format 4 digit
            'grade' => 'required|string|max:255',
        ]);

        // dd($validatedData);

        Education::updateOrCreate(
            ['user_id' => Auth::id()],
            [ // ini yang diupdate
                'last_education' => $validatedData['last_education'],
                'country' => $validatedData['country'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'type' => $validatedData['type'],
                'name_of_institution' => $validatedData['name_of_institution'],
                'departement' => $validatedData['departement'],
                'year_of_graduation' => $validatedData['year_of_graduation'],
                'grade' => $validatedData['grade'],
            ]
        );
        

        // Redirect dengan pesan sukses
        return redirect()->route('personal.data.address')->with('success', 'Data pendidikan berhasil disimpan.');
    }

    public function storeAddress(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
        ]);

        // Menyimpan data pendidikan dengan updateOrCreate
        Address::updateOrCreate(
            ['user_id' => Auth::id(), 'id' => $request->education_id], // Jika ingin update data pendidikan berdasarkan ID pendidikan
            [
                'country' => $validatedData['country'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'district' => $validatedData['district'],
                'village' => $validatedData['village'],
                'address' => $validatedData['address'],
            ]
        );

        // Redirect dengan pesan sukses
        return redirect()->route('personal.data.income')->with('success', 'Data Tempat Tinggal berhasil disimpan.');
    }

    public function storeIncome(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        // Menyimpan data penghasilan dengan updateOrCreate
        Income::updateOrCreate(
            ['user_id' => Auth::id(), 'id' => $request->income_id], // pastikan income_id dikirim dari form
            [
                'user_id' => Auth::id(),
                'source' => $validatedData['source'],
                'amount' => $validatedData['amount'],
            ]
        );

        // Redirect dengan pesan sukses
        return redirect()->route('personal.data.family')->with('success', 'Data Penghasilan berhasil disimpan.');
    }

    public function storeFamily(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id'           => 'nullable|integer',
            'relation'     => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:255',
            'job'          => 'required|string|max:255',
            'education'    => 'required|string|max:255',
            'status'       => 'required|string|max:255',

            'id_2'         => 'nullable|integer',
            'relation_2'   => 'required|string|max:255',
            'name_2'       => 'required|string|max:255',
            'phone_2'      => 'required|string|max:255',
            'job_2'        => 'required|string|max:255',
            'education_2'  => 'required|string|max:255',
            'status_2'     => 'required|string|max:255',
        ]);

        $userAddress = Address::where('user_id', Auth::id())->first();

        // === Data Keluarga 1 ===
        Family::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'id'      => $request->input('id'),
            ],
            [
                'relation'  => $validatedData['relation'],
                'name'      => $validatedData['name'],
                'phone'     => $validatedData['phone'],
                'job'       => $validatedData['job'],
                'education' => $validatedData['education'],
                'status'    => $validatedData['status'],
                'address'   => $request->has('same_address') && $userAddress ? $userAddress->address : $request->input('address'),
            ]
        );

        // === Data Keluarga 2 ===
        Family::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'id'      => $request->input('id_2'),
            ],
            [
                'relation'  => $validatedData['relation_2'],
                'name'      => $validatedData['name_2'],
                'phone'     => $validatedData['phone_2'],
                'job'       => $validatedData['job_2'],
                'education' => $validatedData['education_2'],
                'status'    => $validatedData['status_2'],
                'address'   => $request->has('same_address_2') && $userAddress ? $userAddress->address : $request->input('address_2'),
            ]
        );

        $user = Auth::user();
        $phone = $this->normalizePhone($user->phone);
        $message = "Terima kasih telah melakukan pengisian biodata. Selanjutnya, silakan pilih jalur pendaftaran yang paling sesuai.";

        // Panggil fungsi kirim pesan
        SendWhatsappMessage::dispatchAfterResponse($phone, $message);

        return redirect()->route('beranda')->with('success', 'Data Keluarga berhasil disimpan.');
    }

    private function normalizePhone($phone)
    {
        // Hilangkan spasi, tanda plus, strip, dan karakter aneh lainnya
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika dimulai dengan 0, ubah jadi 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
