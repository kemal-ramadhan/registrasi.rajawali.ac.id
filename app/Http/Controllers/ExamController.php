<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\Questions;
use App\Models\Choices_question;
use App\Models\Exam_lisan;
use App\Models\RegistrationPath;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $exams = Exams::with('registration_path') // <-- memuat relasi
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                        ->orWhere('start_date', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%");
        })->orderBy('created_at', 'desc') // <-- urutkan berdasarkan data terbaru
        ->paginate(20);


        return view('admin.exam.index', compact('exams', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registrations = RegistrationPath::all();
        return view('admin.exam.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_path_id' => 'required|exists:registration_paths,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'pengerjaan' => 'required|string',
            'pengerjaan_waktu' => 'nullable|integer|min:1',
            'type' => 'required|string',
            'status' => 'required',
        ]);

        Exams::create($validated);

        return redirect()->route('exam.index')->with('success', 'Data ujian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exams::find($id);
        $questions = Questions::where('exams_id', $id)->get();
        $jumlah_pilihan_ganda = $questions->where('type', 'pilihan_ganda')->count();
        $jumlah_jawaban_singkat = $questions->where('type', 'jawaban_singkat')->count();
        $jumlah_esai = $questions->where('type', 'esai')->count();
        $totalSoal = $questions->count();
        $totalPoint = $questions->sum('point');
        $choices = Choices_question::all();
        if ($exam->type == 'CBT') {
            return view('admin.exam.show', compact('exam', 'questions', 'choices', 'jumlah_pilihan_ganda', 'jumlah_jawaban_singkat', 'jumlah_esai', 'totalSoal', 'totalPoint'));
        } elseif ($exam->type == 'Lisan') {
            $lisan = Exam_lisan::where('exams_id', $id)->first();
            return view('admin.exam.lisan', compact('exam', 'lisan'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam = Exams::find($id);
        $registrations = RegistrationPath::all();
        return view('admin.exam.edit', compact('exam', 'registrations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'registration_path_id' => 'required|exists:registration_paths,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'pengerjaan' => 'required|string',
            'pengerjaan_waktu' => 'nullable|integer|min:1',
            'type' => 'required|string',
            'status' => 'required',
        ]);

        $exam = Exams::findOrFail($id); // Menemukan data berdasarkan ID

        $exam->update($validated);

        return redirect()->route('exam.show', $id)->with('success', 'Data ujian berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $exam = Exams::findOrFail($id);
        $exam->delete();

        return redirect()->route('exam.index')->with('success', 'Data ujian berhasil dihapus.');
    }
}
