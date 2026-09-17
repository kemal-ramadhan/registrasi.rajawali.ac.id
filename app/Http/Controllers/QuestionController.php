<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\Questions;
use App\Models\Choices_question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $exam = Exams::find($id);
        return view('admin.question.create', compact('exam'));
    }
    
    public function createChoice($id, $question_id)
    {
        $exam = Exams::find($id);
        $question = Questions::find($question_id);
        $choices = Choices_question::where('questions_id', $question_id)->get();
        return view('admin.question.choice', compact('exam', 'question', 'choices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'type'     => 'required|string|in:pilihan_ganda,jawaban_singkat,esai',
            'question' => 'required|string',
            'point'    => 'required|integer|min:1',
        ]);
    
        Questions::create($validated);

        if ($request->type == 'pilihan_ganda') {
            return redirect()->route('question.choice', [$validated['exams_id'], Questions::latest()->first()->id])->with('success', 'Soal berhasil ditambahkan, Silahkan menambahkan jawaban.');
        } else {
            return redirect()->route('exam.show', $validated['exams_id'])->with('success', 'Soal berhasil ditambahkan.');
        }
    
    }

    public function storeChoice(Request $request)
    {
        $validated = $request->validate([
            'questions_id' => 'required|exists:questions,id',
            'choice'       => 'required|string|max:255',
            'is_correct'   => 'nullable|boolean',
        ]);

        // Jika checkbox tidak dicentang, is_correct akan bernilai null
        // Jadi kita set default-nya ke false (0)
        $validated['is_correct'] = $request->has('is_correct') ? 1 : 0;

        Choices_question::create($validated);

        return back()->with('success', 'Pilihan jawaban berhasil ditambahkan.');
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
        $question = Questions::find($id);
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'type'     => 'required|string|in:pilihan_ganda,jawaban_singkat,esai',
            'question' => 'required|string',
            'point'    => 'required|integer|min:1',
        ]);

        $question = Questions::findOrFail($id);
        $question->update($validated);

        // Jika soal diubah menjadi pilihan ganda dan belum ada jawaban, arahkan ke route pilihan ganda
        if ($request->type === 'pilihan_ganda') {
            return redirect()
                ->route('question.choice', [$validated['exams_id'], $question->id])
                ->with('success', 'Soal berhasil diperbarui, silakan tambahkan jawaban.');
        }

        return redirect()
            ->route('exam.show', $validated['exams_id'])
            ->with('success', 'Soal berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari soal berdasarkan id
        $question = Questions::findOrFail($id);
        
        // Menghapus pilihan ganda terkait jika ada
        $question->choices()->delete();

        // Menghapus soal
        $question->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('exam.show', $question->exams_id)
                        ->with('success', 'Soal berhasil dihapus.');
    }
    
    public function destroyChoices(string $id)
    {
        $choice = Choices_question::findOrFail($id);
        $choice->delete();

        return redirect()->back()->with('success', 'Pilihan berhasil dihapus.');
    }
}
