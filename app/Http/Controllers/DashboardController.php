<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\ProgramLevel;
use App\Models\Faculty;
use App\Models\Departement;
use App\Models\Paymant;
use App\Models\Mahasiswa_paymant;
use App\Models\ProgramOption;

use App\Charts\DailyIncomeChart;
use App\Charts\DailyUserChart;
use App\Charts\GenderPie;
use App\Charts\AgeBarChart;
use App\Charts\TopCityBarChart;
use App\Charts\MediaInformationChart;
use App\Charts\RegistrationStatusChart;

class DashboardController extends Controller
{
    public function index(Request $request, DailyIncomeChart $dailyIncomeChart, DailyUserChart $dailyUserChart, GenderPie $genderPie, AgeBarChart $ageBarChart, TopCityBarChart $topCityBarChart, MediaInformationChart $mediaInformationChart, RegistrationStatusChart $registrationStatusChart)
    {
        // Filter untuk Chart Harian User
        $selectedMonth = $request->get('month', now()->month);
        $selectedYear = $request->get('year', now()->year);

        // Filter Rentang Waktu untuk Chart Tahapan Status (Default 1 tahun ini)
        $startDate = $request->get('start_date', Carbon::now()->startOfYear()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfYear()->format('Y-m-d'));

        $mediaInformationChart = $mediaInformationChart->build();
        $chart = $dailyIncomeChart->build();
        $chartUser = $dailyUserChart->build($selectedMonth, $selectedYear); 
        $genderPie = $genderPie->build();
        $ageBarChart = $ageBarChart->build();
        $topCityBarChart = $topCityBarChart->build();
        
        // Membangun chart baru berdasarkan rentang tanggal
        $statusChart = $registrationStatusChart->build($startDate, $endDate);

        $userCount = User::where('role', 'Customer')->count();
        $userCountToday = User::where('role', 'Customer')
            ->whereDate('created_at', Carbon::today())
            ->count();
        $userCountYesterday = User::where('role', 'Customer')
            ->whereDate('created_at', Carbon::yesterday())
            ->count();
        $fakultasCount = Faculty::count();
        $programLavelCount = ProgramLevel::count();
        $departementCount = Departement::count();

        $totalAmountSuccess = Paymant::where('status', 'SUCCESS')->sum('amount');
        $totalAmountPending = Paymant::where('status', 'pending')->sum('amount');
        $totalAmountSuccessToday = Paymant::where('status', 'SUCCESS')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalAmountSuccessYesterday = Paymant::where('status', 'SUCCESS')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        $totalAmountPendingToday = Paymant::where('status', 'pending')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalAmountPendingYesterday = Paymant::where('status', 'pending')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        $totalAmountSuccessDaftarUlang = Mahasiswa_paymant::where('status', 'SUCCESS')->sum('amount');
        $totalAmountPendingDaftarUlang = Mahasiswa_paymant::where('status', 'pending')->sum('amount');
        $totalAmountSuccessTodayDaftarUlang = Mahasiswa_paymant::where('status', 'SUCCESS')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalAmountSuccessYesterdayDaftarUlang = Mahasiswa_paymant::where('status', 'SUCCESS')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        $totalAmountPendingTodayDaftarUlang = Mahasiswa_paymant::where('status', 'pending')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalAmountPendingYesterdayDaftarUlang = Mahasiswa_paymant::where('status', 'pending')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        $verifikasiDokument = ProgramOption::where('status', 'Verifikasi Dokumen')->count();
        $pembayaran = ProgramOption::where('status', 'Pembayaran')->count();
        $uploadDokumen = ProgramOption::where('status', 'Upload Dokumen')->count();
        $verfikasiDokumen = ProgramOption::where('status', 'Verifikasi Dokumen')->count();
        $revisiDokumen = ProgramOption::where('status', 'Revisi Dokumen')->count();
        $prosesSeleksi = ProgramOption::where('status', 'Proses Seleksi')->count();
        $daftarUlang = ProgramOption::where('status', 'Daftar Ulang')->count();
        $generateNIM = ProgramOption::where('status', 'Generate NIM')->count();
        $lulus = ProgramOption::where('status', 'Lulus')->count();

        return view('admin.dashboard.index', compact(
            'chart', 'chartUser', 'userCount', 'genderPie', 'ageBarChart', 'topCityBarChart', 
            'fakultasCount', 'programLavelCount', 'departementCount', 'totalAmountSuccess', 
            'totalAmountPending', 'totalAmountSuccessToday', 'totalAmountPendingToday', 
            'verifikasiDokument', 'pembayaran', 'uploadDokumen', 'verfikasiDokumen', 
            'revisiDokumen', 'prosesSeleksi', 'daftarUlang', 'generateNIM', 'lulus', 
            'userCountToday', 'userCountYesterday', 'totalAmountSuccessYesterday', 
            'totalAmountPendingYesterday', 'totalAmountSuccessDaftarUlang', 'totalAmountPendingDaftarUlang', 
            'totalAmountSuccessTodayDaftarUlang', 'totalAmountPendingTodayDaftarUlang', 
            'totalAmountSuccessYesterdayDaftarUlang', 'totalAmountPendingYesterdayDaftarUlang', 
            'mediaInformationChart', 'statusChart', 'selectedMonth', 'selectedYear', 
            'startDate', 'endDate'
        ));
    }
}