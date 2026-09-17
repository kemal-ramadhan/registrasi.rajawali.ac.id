<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap semua input filter
        $search = $request->input('search');
        $subjectType = $request->input('subject_type');
        $event = $request->input('event');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $perPage = $request->input('per_page', 50); // Default 50 baris per halaman

        // Kamus terjemahan nama model agar enak dibaca di Frontend
        $modelLabels = [
            'App\Models\Paymant' => 'Pembayaran Pendaftaran',
            'App\Models\ProgramOption' => 'Tahapan Seleksi',
            'App\Models\Mahasiswa_paymant' => 'Pembayaran Daftar Ulang',
            'App\Models\RegistrationPath' => 'Jalur Pendaftaran',
            'App\Models\User' => 'Akun Pengguna',
            'App\Models\Mahasiswa' => 'Data Mahasiswa Lulus',
            'App\Models\PersonalData' => 'Data Pribadi',
            'App\Models\Education' => 'Data Pendidikan',
            'App\Models\Address' => 'Data Alamat',
            'App\Models\Income' => 'Data Penghasilan',
            'App\Models\Family' => 'Data Keluarga',
        ];

        // Mengambil daftar model (subject_type) unik yang ada di dalam log untuk dropdown filter
        $subjectTypes = Activity::select('subject_type')
            ->distinct()
            ->whereNotNull('subject_type')
            ->pluck('subject_type');

        // Query data log aktivitas
        $logs = Activity::with(['causer', 'subject'])
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                      ->orWhereHas('causer', function($causerQuery) use ($search){
                          $causerQuery->where('name', 'like', "%{$search}%")
                                      ->orWhere('email', 'like', "%{$search}%");
                      });
                });
            })
            ->when($subjectType, function ($query) use ($subjectType) {
                $query->where('subject_type', $subjectType);
            })
            ->when($event, function ($query) use ($event) {
                $query->where('event', $event);
            })
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->latest()
            ->paginate($perPage);

        return view('admin.activity_log.index', compact(
            'logs', 'search', 'subjectType', 'event', 'startDate', 'endDate', 'perPage', 'subjectTypes', 'modelLabels'
        ));
    }
}