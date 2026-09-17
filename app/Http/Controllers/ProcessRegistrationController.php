<?php

namespace App\Http\Controllers;

use App\Mail\AkunMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Jobs\SendWhatsappMessage;

use App\Models\ProgramOption;
use App\Models\PersonalData;
use App\Models\Education;
use App\Models\Address;
use App\Models\Family;
use App\Models\Income;
use App\Models\DokumenFirst;
use App\Models\RegistrationDokumen;
use App\Models\DocumentRequirement;
use App\Models\Paymant;
use App\Models\AkunSistem;
use App\Models\User;
use App\Models\RegistrationPath;
use App\Models\Exam_participants;
use App\Models\Exams;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_paymant;
use App\Models\NimSequence;
use App\Models\PembayaranBK;
use PhpParser\Node\Stmt\Return_;

class ProcessRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $tab    = $request->input('tab', 'aktif'); // aktif | terhapus | statistik

        $query = ProgramOption::with([
                'user',
                'registrationPath',
                'departement',
                'mahasiswa'
            ])
            ->select(
                'id',
                'user_id',
                'registration_path_id',
                'departement_id',
                'status',
                'created_at',
                'deleted_at'
            );

        if ($tab === 'terhapus') {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }

        $query->when($search, function ($q) use ($search) {
            $q->where(function ($q2) use ($search) {

                // Search berdasarkan User
                $q2->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                })

                // Search berdasarkan NIM
                ->orWhereHas('mahasiswa', function ($m) use ($search) {
                    $m->where('nim', 'like', "%{$search}%");
                })

                // Search berdasarkan Jalur
                ->orWhereHas('registrationPath', function ($p) use ($search) {
                    $p->where('name', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                })

                // Search berdasarkan Prodi
                ->orWhereHas('departement', function ($d) use ($search) {
                    $d->where('name', 'like', "%{$search}%");
                });
            });
        })
        ->when($status, function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->orderBy('created_at', 'desc');

        $datas = $query->paginate(30);

        // -- Statistik double daftar --
        $stats = [];

        if ($tab === 'statistik') {

            // Double jalur SAMA & prodi SAMA
            $stats['double_same'] = \DB::select("
                SELECT u.name, u.email, u.phone,
                    rp.title as jalur, d.name as prodi,
                    GROUP_CONCAT(po.id ORDER BY po.created_at) as po_ids,
                    GROUP_CONCAT(po.status ORDER BY po.created_at) as statuses,
                    COUNT(*) as jumlah
                FROM program_options po
                JOIN users u ON u.id = po.user_id
                JOIN registration_paths rp ON rp.id = po.registration_path_id
                JOIN departements d ON d.id = po.departement_id
                WHERE po.deleted_at IS NULL
                GROUP BY po.user_id, po.registration_path_id, po.departement_id
                HAVING COUNT(*) > 1
                ORDER BY jumlah DESC, u.name
            ");

            // Lebih dari 2 jalur berbeda
            $stats['multi_jalur'] = \DB::select("
                SELECT u.name, u.email, u.phone,
                    COUNT(*) as jumlah_jalur,
                    GROUP_CONCAT(DISTINCT rp.title ORDER BY rp.title SEPARATOR ' | ') as jalur_list,
                    GROUP_CONCAT(DISTINCT d.name ORDER BY d.name SEPARATOR ' | ') as prodi_list
                FROM program_options po
                JOIN users u ON u.id = po.user_id
                JOIN registration_paths rp ON rp.id = po.registration_path_id
                JOIN departements d ON d.id = po.departement_id
                WHERE po.deleted_at IS NULL
                GROUP BY po.user_id
                HAVING COUNT(*) > 2
                ORDER BY jumlah_jalur DESC, u.name
            ");

            // LULUS lebih dari 1
            $stats['multi_lulus'] = \DB::select("
                SELECT u.name, u.email, u.phone,
                    COUNT(*) as jumlah_lulus,
                    GROUP_CONCAT(rp.title ORDER BY rp.title SEPARATOR ' | ') as jalur_list,
                    GROUP_CONCAT(d.name ORDER BY d.name SEPARATOR ' | ') as prodi_list
                FROM program_options po
                JOIN users u ON u.id = po.user_id
                JOIN registration_paths rp ON rp.id = po.registration_path_id
                JOIN departements d ON d.id = po.departement_id
                WHERE po.status = 'LULUS' AND po.deleted_at IS NULL
                GROUP BY po.user_id
                HAVING COUNT(*) > 1
                ORDER BY jumlah_lulus DESC, u.name
            ");

            // Daftar Ulang + Lulus bersamaan
            $stats['daftar_ulang_lulus'] = \DB::select("
                SELECT u.name, u.email, u.phone,
                    GROUP_CONCAT(po.status ORDER BY po.status SEPARATOR ' | ') as statuses,
                    GROUP_CONCAT(rp.title ORDER BY po.status SEPARATOR ' | ') as jalur_list,
                    GROUP_CONCAT(d.name ORDER BY po.status SEPARATOR ' | ') as prodi_list
                FROM program_options po
                JOIN users u ON u.id = po.user_id
                JOIN registration_paths rp ON rp.id = po.registration_path_id
                JOIN departements d ON d.id = po.departement_id
                WHERE po.deleted_at IS NULL
                GROUP BY po.user_id
                HAVING SUM(po.status = 'Daftar Ulang') > 0
                AND SUM(po.status = 'LULUS') > 0
                ORDER BY u.name
            ");
        }

        return view(
            'admin.process.index',
            compact('datas', 'search', 'status', 'tab', 'stats')
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'departement_id' => 'required|integer|exists:departements,id',
            'nim' => 'required|string|unique:mahasiswas,nim', // ganti 'tests' ke 'mahasiswas'
            'angkatan' => 'required|string',
            'status' => 'nullable|in:aktif,nonaktif', // jadikan nullable supaya bisa default
        ]);

        if (!isset($validated['status'])) {
            $validated['status'] = 'aktif';
        }

        Mahasiswa::create($validated);


        return redirect()->back()->with('success', 'Akun berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programOption = ProgramOption::find($id);
        if (!$programOption) {
            return redirect()->back()->with('error', 'Program Option tidak ditemukan.');
        }

        $registrationPath = $programOption->registrationPath;
        $user = $programOption->user;

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $personalData = PersonalData::where('user_id', $user->id)->first();
        $education = Education::where('user_id', $user->id)->first();
        $address = Address::where('user_id', $user->id)->first();
        $income = Income::where('user_id', $user->id)->first();
        $families = Family::where('user_id', $user->id)->get();

        $dokumenAwal = DokumenFirst::where('user_id', $user->id)->first();
        $dokumenSyarats = RegistrationDokumen::where('registration_path_id', $programOption->registration_path_id)->get();

        $paymants = Paymant::where('program_option_id', $id)->get();

        $paymantMahasiswas = Mahasiswa_paymant::where('user_id', $user->id)->with('biaya')->get();

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Cek data ujian
        $exam = Exams::where('registration_path_id', $programOption->registration_path_id)
            ->with('registration_path.programOptions.departement')
            ->first();

        $participant = null;
        if ($exam) {
            $participant = Exam_participants::where('user_id', $user->id)
                ->where('exams_id', $exam->id)
                ->first();
        }

        $pembayaranBk = PembayaranBK::where('program_option_id', $id)->first();

        return view('admin.process.show', compact(
            'programOption',
            'registrationPath',
            'user',
            'personalData',
            'education',
            'address',
            'income',
            'families',
            'dokumenAwal',
            'dokumenSyarats',
            'paymants',
            'paymantMahasiswas',
            'mahasiswa',
            'exam',
            'participant',
            'pembayaranBk',
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
        $program_option_id = $request->program_option_id;

        $validatedData = $request->validate([
            'komentarDokumenAwal' => 'nullable|string',
            'statusDokumenAwal' => 'nullable|string',
        ]);

        // Flag untuk menandai jika ada dokumen yang "Tidak Sesuai"
        $hasRevision = false;

        // Cari dokumen awal berdasarkan user_id
        $dokumenAwal = DokumenFirst::where('user_id', $id)->first();

        if ($dokumenAwal) {
            // Update deskripsi dan status dokumen awal
            $dokumenAwal->description = $validatedData['komentarDokumenAwal'];
            $dokumenAwal->status = $validatedData['statusDokumenAwal'];
            $dokumenAwal->save();

            // Jika status dokumen awal "Tidak Sesuai", tandai revisi
            if ($dokumenAwal->status == 'Tidak Sesuai') {
                $hasRevision = true;
            }
        }

        logger($request->all());

        if ($request->has('komentar') && $request->has('status')) {
            foreach ($request->komentar as $syaratId => $komentar) {
                $dokumenRequirement = DocumentRequirement::where([
                    'program_option_id' => $request->program_option_id, // tambahkan ini jika perlu
                    'registration_dokumen_id' => $syaratId,
                ])->first();

                if ($dokumenRequirement) {
                    $dokumenRequirement->description = $komentar;
                    $dokumenRequirement->status = $request->status[$syaratId] ?? 'Sesuai';

                    if ($dokumenRequirement->status == 'Tidak Sesuai') {
                        $hasRevision = true;
                    }

                    $dokumenRequirement->save();
                } else {
                    return redirect()->back()->with('success', "Dokumen requirement tidak ditemukan untuk syarat ID: $syaratId");
                }
            }
        }


        // Update status di tabel ProgramOption hanya sekali di akhir
        $programOption = ProgramOption::find($program_option_id);
        if ($programOption) {
            $programOption->status = $hasRevision ? 'Revisi Dokumen' : 'Proses Seleksi';
            $programOption->save();
        }

        $user = User::find($id);
        $phone = $this->normalizePhone($user->phone);
        if ($hasRevision == 'Revisi Dokumen') {
            $message = "Hai, {$user->name}!\n\n"
            . "Dokumen kamu sudah diverifikasi dengan status *Revisi Dokumen*. Silakan segera melengkapi dokumen kamu. Terima kasih.";
        } else {
            $message = "Hai, {$user->name}!\n\n"
            . "Dokumen kamu telah selesai kami verifikasi untuk selanjutnya silahkan cek status pendaftaran kamu di sistem. Terima kasih.";
        }
        SendWhatsappMessage::dispatchAfterResponse($phone, $message);



        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui!');
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


    public function updatePaymentStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required',
        ]);

        // Cari pembayaran berdasarkan ID
        $payment = Paymant::findOrFail($id);

        // Update status pembayaran
        $payment->status = $request->status;
        $payment->save();

        $programOption = ProgramOption::find($payment->program_option_id);
        $programOption->status = 'Upload Dokumen';
        $programOption->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
    
    public function updatePaymentStatusBk(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_keuangan' => 'required',
        ]);

        $pembayaran = PembayaranBK::findOrFail($id);
        $pembayaran->status_keuangan = $request->status_keuangan;
        $pembayaran->save();

        if ($request->status_keuangan == 'Success') {
            // Cari pembayaran berdasarkan ID
            $payment = Paymant::findOrFail($request->paymant_id);

            // Update status pembayaran
            $payment->status = "SUCCESS";
            $payment->save();
        } elseif ($request->status_keuangan == 'Tagihan') {
            // Cari pembayaran berdasarkan ID
            $payment = Paymant::findOrFail($request->paymant_id);

            // Update status pembayaran
            $payment->status = "Tagihan";
            $payment->save();
        }

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
    
    public function updatePaymentMahasiswaStatus(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'status' => 'required|in:pendding,FAILED,SUCCESS,EXPIRED',
        ]);

        // Cari pembayaran berdasarkan ID
        $payment = Mahasiswa_paymant::find($id);

        // Update status pembayaran
        $payment->status = $request->status;
        $payment->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }

    public function updateRegistrationStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required',
        ]);

        // Cari pembayaran berdasarkan ID
        $programOption = ProgramOption::findOrFail($id);

        // Update status pembayaran
        $programOption->status = $request->status;
        $programOption->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status berhasil diperbarui!');
    }
    
    public function generateNim(Request $request, $id)
    {
        $programOption = ProgramOption::with([
            'departement.faculty.programLevel',
            'registrationPath',
            'user'
        ])->findOrFail($id);

        // 1️⃣ Validasi status
        if ($programOption->status !== 'Generate NIM') {
            return back()->with('error', 'Status tidak valid untuk generate NIM');
        }

        DB::transaction(function () use ($programOption) {

            $departement = $programOption->departement;
            $faculty     = $departement->faculty;
            $level       = $faculty->programLevel;
            $path        = $programOption->registrationPath;

            // Tahun masuk → 24
            $year = substr($path->code_year, -2);

            // 2️⃣ Ambil & kunci sequence
            $sequence = NimSequence::lockForUpdate()->firstOrCreate(
                [
                    'departement_id' => $departement->id,
                    'year' => $year,
                    'registration_path_code' => $path->code,
                ],
                ['last_number' => 0]
            );

            // 3️⃣ Naikkan urutan
            $sequence->increment('last_number');

            $urut = str_pad($sequence->last_number, 3, '0', STR_PAD_LEFT);

            // 4️⃣ Bentuk NIM
            $nim =
                $faculty->code .
                $departement->code .
                $level->code .
                $path->code .
                $year .
                $urut;

            // 5️⃣ Simpan ke tabel mahasiswas
            Mahasiswa::create([
                'user_id' => $programOption->user_id,
                'departement_id' => $departement->id,
                'nim' => $nim,
                'angkatan' => '20' . $year,
                'status' => 'AKTIF',
            ]);

            // 6️⃣ Update status ProgramOption
            $programOption->update([
                'status' => 'LULUS'
            ]);
        });

        return back()->with('success', 'NIM berhasil digenerate dan mahasiswa dinyatakan LULUS');
    }

    private function saveToSheetDB(ProgramOption $programOption)
    {

        $programOption = ProgramOption::find($programOption->id);
        $registrationPath = $programOption->registrationPath;

        $user = User::where('id', $programOption->user_id)->first();
        $personalData = PersonalData::where('user_id', $user->id)->first();
        $address = Address::where('user_id', $user->id)->first();
        $families = Family::where('user_id', $user->id)->get();
        $education = Education::where('user_id', $user->id)->first();
        $income = Income::where('user_id', $user->id)->first();

        $webhook_url = 'https://script.google.com/macros/s/AKfycbzvLXCGu_BiweS4GZ1TGq9AqwaRwBMi_27iytj3nI_OSnFSCaFGCjXkw-YosUNO3sY/exec';

        $data = [
            'kode' => $personalData->nik,
            'tanggal' => $programOption->created_at->format('Y-m-d'),
            'name' => $user->name,
            'gander' => $personalData->gander,
            'agama' => $personalData->religion,
            'tempat_lahir' => $personalData->place_of_birth,
            'tanggal_lahir' => $personalData->date_of_birth,
            'alamat' => $address->address,
            'nik' => $personalData->nik,
            'no_hp' => $user->phone,
            'email' => $user->email,
            'families' => $families->map(function ($family) {
                return [
                    'relation' => $family->relation,
                    'name' => $family->name,
                    'pendidikan' => $family->education,
                    'job' => $family->job,
                    'status' => $family->status,
                    'alamat' => $family->address,
                ];
            })->values()->toArray(), // <-- ini penting untuk pastikan JSON bersih
            'pendidikan' => $education->last_education,
            'nisn' => $personalData->nisn,
            'name_of_institution' => $education->name_of_institution,
            'departement' => $education->departement,
            'year_of_graduation' => $education->year_of_graduation,
            'grade' => $education->grade,
            'source_of_income' => $income->source,
            'amount_of_income' => $income->amount,
            'status' => $programOption->status,
            'tanggal_input' => now()->format('Y-m-d'),
            'registration_path_name' => $programOption->registrationPath->name,
            'registration_path_title' => $programOption->registrationPath->title,
            'registration_path_program' => $programOption->departement->name,
        ];

        Log::info('Mengirim data ke Google Sheets:', $data);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($webhook_url, $data);

            Log::info('Response dari Google Sheets:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim data ke Google Sheets:', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


 public function softDelete($id)
    {
        $programOption = ProgramOption::findOrFail($id);
        $programOption->delete(); // soft delete
        return back()->with('success', 'Data berhasil dipindahkan ke recycle bin.');
    }
 
    public function restore($id)
    {
        $programOption = ProgramOption::withTrashed()->findOrFail($id);
        $programOption->restore();
        return back()->with('success', 'Data berhasil dipulihkan.');
    }
 
    public function forceDelete($id)
    {
        $programOption = ProgramOption::withTrashed()->findOrFail($id);
        // Hapus relasi dulu
        \DB::table('paymants')->where('program_option_id', $id)->delete();
        \DB::table('document_requirements')->where('program_option_id', $id)->delete();
        $programOption->forceDelete();
        return back()->with('success', 'Data berhasil dihapus permanen.');
    }
 
    public function cleanOldDeleted()
    {
        // Hard delete data yang sudah di-soft delete lebih dari 30 hari
        $count = ProgramOption::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(30))
            ->count();
 
        ProgramOption::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(30))
            ->each(function ($po) {
                \DB::table('paymants')->where('program_option_id', $po->id)->delete();
                \DB::table('document_requirements')->where('program_option_id', $po->id)->delete();
                $po->forceDelete();
            });
 
        return back()->with('success', "{$count} data lama berhasil dihapus permanen.");
    }
}
