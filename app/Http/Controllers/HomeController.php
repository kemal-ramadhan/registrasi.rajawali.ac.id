<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\PersonalData;
use App\Models\Education;
use App\Models\Address;
use App\Models\Income;
use App\Models\Family;
use App\Models\Paymant;
use App\Models\ProgramOption;
use App\Models\Mahasiswa;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $personalData = PersonalData::where('user_id', $userId)->first();
        $address = Address::where('user_id', $userId)->first();
        $income = Income::where('user_id', $userId)->first();
        $family = Family::where('user_id', $userId)->first();
        $education = Education::where('user_id', $userId)->first();

        $missingData = [];

        if (!$personalData) $missingData[] = 'Data Pribadi';
        if (!$address) $missingData[] = 'Alamat';
        if (!$income) $missingData[] = 'Data Penghasilan';
        if (!$family) $missingData[] = 'Data Keluarga';
        if (!$education) $missingData[] = 'Data Pendidikan';

        $totalSections = 5;
        $completedSections = $totalSections - count($missingData);
        $progressPercentage = round(($completedSections / $totalSections) * 100);

        $mahasiswa = Mahasiswa::where('user_id', $userId)->with('departement')->first();

        $programOptions = ProgramOption::select(
            'departements.name as departement_name',
            'registration_paths.name as registration_name',
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
            ->where('program_options.user_id', Auth::id()) // Menggunakan user yang sedang login
            ->get();

        return view('customer.home.index', compact('mahasiswa', 'missingData', 'progressPercentage', 'completedSections', 'totalSections', 'programOptions'));
    }


    public function indexJalurPendaftaran()
    {
        $programOptions = ProgramOption::select(
            'departements.name as departement_name',
            'registration_paths.name as registration_name',
            'registration_paths.title',
            'registration_paths.start_date',
            'registration_paths.end_date',
            'program_options.status',
            'program_options.program_option',
            'program_options.id'
        )
            ->join('departements', 'program_options.departement_id', '=', 'departements.id')
            ->join('registration_paths', 'program_options.registration_path_id', '=', 'registration_paths.id')
            ->where('program_options.user_id', Auth::id()) // Menggunakan user yang sedang login
            ->get();
        $userId = Auth::id();

        // Ambil data terkait
        $personalData = PersonalData::where('user_id', $userId)->first();
        $address = Address::where('user_id', $userId)->first();
        $income = Income::where('user_id', $userId)->first();
        $family = Family::where('user_id', $userId)->first();
        $education = Education::where('user_id', $userId)->first();

        // Cek apakah ada data yang belum diisi
        $missingData = [];

        if (!$personalData) $missingData[] = 'Data Pribadi belum diisi.';
        if (!$address) $missingData[] = 'Alamat belum diisi.';
        if (!$income) $missingData[] = 'Data Penghasilan belum diisi.';
        if (!$family) $missingData[] = 'Data Keluarga belum diisi.';
        if (!$education) $missingData[] = 'Data Pendidikan belum diisi.';

        $myPaymants = Paymant::with(['programOption.departement', 'paymantMethod'])->where('user_id', $userId)->get();

        return view('customer.home.home', compact('personalData', 'address', 'income', 'family', 'education', 'missingData', 'programOptions', 'myPaymants'));
    }
}
