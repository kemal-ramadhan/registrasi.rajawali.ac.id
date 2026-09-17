<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ProgramLevel;
use App\Models\Faculty;
use App\Models\Departement;
use App\Models\RegistrationDepartement;
use App\Models\RegistrationPath;


class RegistrationController extends Controller
{
    public function index()
    {
        $programs = ProgramLevel::all();
        return view('customer.program.index', compact('programs'));
    }
    
    public function indexFakultas(Request $request, $id)
    {
        $program = ProgramLevel::findOrFail($id);
        $search = $request->input('search');

        // Ambil semua fakultas dari program
        $fakultasQuery = Faculty::where('program_level_id', $id);

        // Ambil semua departemen
        $departementsQuery = Departement::query();

        // Jika ada pencarian, filter dua-duanya
        if ($search) {
            // Cari departemen yang namanya mirip
            $departementsQuery->where('name', 'like', '%' . $search . '%');

            // Ambil faculty_id dari departemen yang cocok
            $facultyIdsFromDepartments = Departement::where('name', 'like', '%' . $search . '%')
                ->pluck('faculty_id')
                ->toArray();

            // Tambahkan juga pencarian berdasarkan fakultas name
            $fakultasQuery->where(function ($query) use ($search, $facultyIdsFromDepartments) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereIn('id', $facultyIdsFromDepartments);
            });
        }

        $fakultas = $fakultasQuery->get();
        $departements = $departementsQuery->get();

        return view('customer.program.fakultas', compact('program', 'fakultas', 'departements'));
    }
    
    public function indexDepartement(Request $request, $id)
    {
        $search = $request->input('search');

        // Ambil semua fakultas dari program
        $departements = Departement::where('faculty_id', $id)->get();
        $fakultas = Faculty::where('id', $id)->first();

        return view('customer.program.departement', compact('departements', 'fakultas'));
    }
    
    public function indexPath($id)
    {
        
        $departement = Departement::where('id', $id)->first();
        $fakultas = Faculty::where('id', $departement->faculty_id)->first();
        $program = ProgramLevel::where('id', $fakultas->program_level_id)->first();
        $registrations = RegistrationDepartement::where('departement_id', $id)->get();
        $registrationsPaths = RegistrationPath::whereIn('status', ['open', 'Publish'])->get();
        return view('customer.program.registration', compact('departement', 'fakultas', 'program', 'registrations', 'registrationsPaths'));
    }
    
    public function indexPathDetail($id, $idDepartement)
    {
        
        $registrationsPath = RegistrationPath::where('id', $id)->first();
        $registrations = RegistrationDepartement::where('id', $idDepartement)->first();
        $departement = Departement::where('id', $idDepartement)->first();
        $fakultas = Faculty::where('id', $departement->faculty_id)->first();
        $program = ProgramLevel::where('id', $fakultas->program_level_id)->first();
        return view('customer.program.registrationDetail', compact('departement', 'fakultas', 'program', 'registrations', 'registrationsPath'));
    }
}
