<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\ProgramOption;
use App\Models\RegistrationPath;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $registrationPathId = $request->input('registration_path_id');
        $departementId = $request->input('departement_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika filter "Belum Memilih Program" diaktifkan
        if ($status === 'Belum Memilih Program') {
            $users = User::with(['personal'])
                ->where(function ($query) {
                    $query->where('role', 'Customer')->orWhereNull('role');
                })
                ->whereNotIn('id', function ($query) {
                    $query->select('user_id')->from('program_options')->whereNotNull('user_id');
                })
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                })
                ->when($startDate, function ($query) use ($startDate) {
                    $query->whereDate('created_at', '>=', $startDate);
                })
                ->when($endDate, function ($query) use ($endDate) {
                    $query->whereDate('created_at', '<=', $endDate);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(30);

            // Manipulasi data agar view Blade tidak error saat memanggil relasi
            $users->getCollection()->transform(function ($user) {
                $dummy = new ProgramOption();
                $dummy->id = 0;
                $dummy->user_id = $user->id;
                $dummy->registration_path_id = null;
                $dummy->departement_id = null;
                $dummy->status = 'Belum Memilih Program';
                $dummy->created_at = $user->created_at;
                
                $dummy->setRelation('user', $user);
                $dummy->setRelation('registrationPath', null);
                $dummy->setRelation('departement', null);
                
                return $dummy;
            });

            $datas = $users;
        } else {
            // Logika default untuk status lainnya
            $datas = ProgramOption::with(['user', 'registrationPath', 'departement'])
                ->select('id', 'user_id', 'registration_path_id', 'departement_id', 'status', 'created_at')
                ->when($search, function ($query) use ($search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    })->orWhereHas('registrationPath', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%");
                    })->orWhereHas('departement', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->when($status, function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->when($departementId, function ($query) use ($departementId) {
                    $query->where('departement_id', $departementId);
                })
                ->when($registrationPathId, function ($query) use ($registrationPathId) {
                    $query->where('registration_path_id', $registrationPathId);
                })
                ->when($startDate, function ($query) use ($startDate) {
                    $query->whereDate('created_at', '>=', $startDate);
                })
                ->when($endDate, function ($query) use ($endDate) {
                    $query->whereDate('created_at', '<=', $endDate);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(30);
        }

        $registrations = RegistrationPath::all();
        $departements = Departement::all();

        return view('admin.reports.index', compact('registrations', 'datas', 'search', 'status', 'registrationPathId', 'startDate', 'endDate', 'departements'));
    }

    public function export(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $registrationPathId = $request->input('registration_path_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($status === 'Belum Memilih Program') {
            $users = User::with(['personal', 'education', 'address', 'income', 'family'])
                ->where(function ($query) {
                    $query->where('role', 'Customer')->orWhereNull('role');
                })
                ->whereNotIn('id', function ($query) {
                    $query->select('user_id')->from('program_options')->whereNotNull('user_id');
                })
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                })
                ->when($startDate, function ($query) use ($startDate) {
                    $query->whereDate('created_at', '>=', $startDate);
                })
                ->when($endDate, function ($query) use ($endDate) {
                    $query->whereDate('created_at', '<=', $endDate);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            // Mapping data user menjadi format ProgramOption dummy agar loop excel tetap berjalan
            $datas = $users->map(function($user) {
                $dummy = new ProgramOption();
                $dummy->status = 'Belum Memilih Program';
                $dummy->created_at = $user->created_at;
                
                $dummy->setRelation('user', $user);
                $dummy->setRelation('mahasiswa', null);
                $dummy->setRelation('registrationPath', null);
                $dummy->setRelation('departement', null);
                
                return $dummy;
            });
        } else {
            // Query sesuai filter (sama dengan fungsi index)
            $datas = ProgramOption::with(['user', 'user.personal', 'user.education', 'user.address', 'user.income', 'user.family', 'registrationPath', 'departement', 'mahasiswa'])
                ->select('id', 'user_id', 'registration_path_id', 'departement_id', 'status', 'created_at')
                ->when($search, function ($query) use ($search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    })->orWhereHas('registrationPath', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%");
                    })->orWhereHas('departement', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->when($status, fn ($q) => $q->where('status', $status))
                ->when($registrationPathId, fn ($q) => $q->where('registration_path_id', $registrationPathId))
                ->when($startDate, fn ($q) => $q->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn ($q) => $q->whereDate('created_at', '<=', $endDate))
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Buat spreadsheet
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Header Excel
        $sheet->setCellValue('A1', 'No Pendaftar');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Angkatan');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'NIK');
        $sheet->setCellValue('F1', 'NISN');
        $sheet->setCellValue('G1', 'Jenis Kelamin');
        $sheet->setCellValue('H1', 'Agama');
        $sheet->setCellValue('I1', 'Tempat Lahir');
        $sheet->setCellValue('J1', 'Tanggal Lahir');
        $sheet->setCellValue('K1', 'Email');
        $sheet->setCellValue('L1', 'Telepon');
        $sheet->setCellValue('M1', 'Alamat');
        $sheet->setCellValue('N1', 'Pendidikan Terakhir');
        $sheet->setCellValue('O1', 'Nama Sekolah');
        $sheet->setCellValue('P1', 'Jenis Sekolah');
        $sheet->setCellValue('Q1', 'Negara');
        $sheet->setCellValue('R1', 'Provinsi');
        $sheet->setCellValue('S1', 'Kota');
        $sheet->setCellValue('T1', 'Jurusan Sekolah');
        $sheet->setCellValue('U1', 'Tahun Lulus');
        $sheet->setCellValue('V1', 'Nilai Terakhir');
        $sheet->setCellValue('W1', 'Sumber Penghasilan');
        $sheet->setCellValue('X1', 'Penghasilan');
        $sheet->setCellValue('Y1', 'Gelombang');
        $sheet->setCellValue('Z1', 'Jalur Pendaftaran');
        $sheet->setCellValue('AA1', 'Program Studi');
        $sheet->setCellValue('AB1', 'Status');
        $sheet->setCellValue('AC1', 'Tanggal Daftar');
        $sheet->setCellValue('AD1', 'Status Keluarga 1');
        $sheet->setCellValue('AE1', 'Nama Keluarga 1');
        $sheet->setCellValue('AF1', 'Pekerjaan Keluarga 1');
        $sheet->setCellValue('AG1', 'HP Keluarga 1');

        $sheet->setCellValue('AH1', 'Status Keluarga 2');
        $sheet->setCellValue('AI1', 'Nama Keluarga 2');
        $sheet->setCellValue('AJ1', 'Pekerjaan Keluarga 2');
        $sheet->setCellValue('AK1', 'HP Keluarga 2');

        // Isi data ke Excel
        $row = 2;
        foreach ($datas as $key => $data) {
            $sheet->setCellValue(
                'A'.$row,
                $data->user->created_at->format('Ymd').($data->user->id ?? '-').($data->id ? '-'.$data->id : '')            
		);
            $sheet->setCellValue('B'.$row, $data->mahasiswa->nim ?? '-');
            $sheet->setCellValue('C'.$row, $data->mahasiswa->angkatan ?? '-');
            $sheet->setCellValue('D'.$row, $data->user->name ?? '-');
            $sheet->setCellValue('E'.$row, $data->user->personal->nik ?? '-');
            $sheet->setCellValue('F'.$row, $data->user->personal->nisn ?? '-');
            $sheet->setCellValue('G'.$row, $data->user->personal->gander ?? '-');
            $sheet->setCellValue('H'.$row, $data->user->personal->religion ?? '-');
            $sheet->setCellValue('I'.$row, $data->user->personal->place_of_birth ?? '-');
            $sheet->setCellValue('J'.$row, $data->user->personal->date_of_birth ?? '-');
            $sheet->setCellValue('K'.$row, $data->user->email ?? '-');
            $sheet->setCellValue('L'.$row, $data->user->phone ?? '-');
            $sheet->setCellValue('M'.$row, $data->user->address->address ?? '-');
            $sheet->setCellValue('N'.$row, $data->user->education->last_education ?? '-');
            $sheet->setCellValue('O'.$row, $data->user->education->name_of_institution ?? '-');
            $sheet->setCellValue('P'.$row, $data->user->education->type ?? '-');
            $sheet->setCellValue('Q'.$row, $data->user->education->country ?? '-');
            $sheet->setCellValue('R'.$row, $data->user->education->province ?? '-');
            $sheet->setCellValue('S'.$row, $data->user->education->city ?? '-');
            $sheet->setCellValue('T'.$row, $data->user->education->departement ?? '-');
            $sheet->setCellValue('U'.$row, $data->user->education->year_of_graduation ?? '-');
            $sheet->setCellValue('V'.$row, $data->user->education->grade ?? '-');
            $sheet->setCellValue('W'.$row, $data->user->income->source ?? '-');
            $sheet->setCellValue('X'.$row, $data->user->income->amount ?? '-');
            $sheet->setCellValue('Y'.$row, $data->registrationPath->name ?? '-');
            $sheet->setCellValue('Z'.$row, $data->registrationPath->title ?? '-');
            $sheet->setCellValue('AA'.$row, $data->departement->name ?? '-');
            $sheet->setCellValue('AB'.$row, $data->status ?? '-');
            $sheet->setCellValue('AC'.$row, $data->created_at->format('d-m-Y'));
            $families = optional($data->user)->family ?? collect();

            // Ambil maksimal 2 data keluarga
            $families = $families->values()->take(2);

            // FAMILY 1
            $sheet->setCellValue('AD'.$row, $families[0]->relation ?? '-');
            $sheet->setCellValue('AE'.$row, $families[0]->name ?? '-');
            $sheet->setCellValue('AF'.$row, $families[0]->job ?? '-');
            $sheet->setCellValue('AG'.$row, $families[0]->phone ?? '-');

            // FAMILY 2
            $sheet->setCellValue('AH'.$row, $families[1]->relation ?? '-');
            $sheet->setCellValue('AI'.$row, $families[1]->name ?? '-');
            $sheet->setCellValue('AJ'.$row, $families[1]->job ?? '-');
            $sheet->setCellValue('AK'.$row, $families[1]->phone ?? '-');

            $row++;
        }

        // Auto width semua kolom
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        // Buat nama file export dinamis sesuai tanggal
        $fileName = 'data_pendaftar_'.now()->format('Ymd_His').'.xlsx';

        // Stream hasilnya ke browser (langsung download)
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    public function kartuPeserta($id)
    {
        $programOption = ProgramOption::select(
            'departements.name as departement_name',
            'registration_paths.name as registration_name',
            'registration_paths.id as registration_path_id',
            'registration_paths.title',
            'registration_paths.start_date',
            'registration_paths.end_date',
            'registration_paths.link_grup',
            'program_options.status',
            'program_options.program_option',
            'program_options.id'
        )
            ->join('departements', 'program_options.departement_id', '=', 'departements.id')
            ->join('registration_paths', 'program_options.registration_path_id', '=', 'registration_paths.id')
            ->where('program_options.id', $id)
            ->first();

        $akun = Auth::user();
        $personal = $akun->personal;

        // Render PDF
        $pdf = Pdf::loadView('pdfs.akun', [
            'programOption' => $programOption,
            'akun' => $akun,
            'personal' => $personal,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('kartu-peserta.pdf');
    }

    // Fungsi Baru: Update Email Pendaftar
    public function updateEmail(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $existingUser = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'Email tersebut sudah terdaftar pada akun lain.']);
        }

        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Email atas nama ' . $user->name . ' berhasil diperbarui!');
    }

    // Fungsi Baru: Hapus User / Pendaftar
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;

        // Hapus program option terkait agar tidak orphaned (jika cascade delete belum diset di database)
        ProgramOption::where('user_id', $user->id)->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Data pendaftar atas nama ' . $name . ' berhasil dihapus secara permanen!');
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