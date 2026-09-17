<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Exam_participants;
use App\Models\Exams;
use App\Models\Questions;
use App\Models\Choices_question;
use App\Models\Answer;
use App\Models\Mahasiswa;
use App\Models\Departement;
use App\Models\RegistrationPath;
use App\Models\Result;
use Google\Service\Classroom\Resource\Registrations;

class CheckSeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $search = $request->input('search');

        $participants = Exam_participants::where('exams_id', $id)
            ->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(10);

        $exam = Exams::findOrFail($id);

        return view('admin.result.index', compact('participants', 'search', 'exam'));
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
    public function storeHasil(Request $request)
    {
        $request->validate([
            'exam_participants_id' => 'required|exists:exam_participants,id',
            'score' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $result = Result::updateOrCreate(
            ['exam_participants_id' => $request->exam_participants_id], // kondisi pencarian
            [ // data yang akan diupdate/insert
                'score' => $request->score,
                'description' => $request->description,
                'status' => $request->status,
            ]
        );

        $participant = Exam_participants::findOrFail($request->exam_participants_id);
        $participant->update([
            'status' => 'Finish',
        ]);

        return redirect()->route('process.index', ['search' => $request->email])->with('success', 'Hasil ujian berhasil disimpan atau diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $examId, $userId)
    {
        $participant = Exam_participants::with(['answers.question', 'answers.choice']) // eager load
            ->where('user_id', $userId)
            ->where('exams_id', $examId)
            ->first();

        $exam = Exams::findOrFail($examId);

        $answers = $participant->answers;

        $correctAnswers = $answers->where('is_correct', true)->count();
        $totalQuestions = Questions::where('exams_id', $examId)->count();

        // Total skor peserta
        $totalPoint = $answers->sum('point');

        // Total maksimal skor ujian (misalnya tiap soal 1 poin)
        $maxPoint = Questions::where('exams_id', $examId)->sum('point');

        return view('admin.result.show', compact(
            'participant',
            'exam',
            'answers',
            'correctAnswers',
            'totalQuestions',
            'totalPoint',
            'maxPoint'
        ));
    }

    public function nilai(string $examId, $userId)
    {
        $participant = Exam_participants::with('user', 'exam') // eager load
            ->where('user_id', $userId)
            ->where('exams_id', $examId)
            ->first();

        $exam = Exams::findOrFail($examId);
        $result = Result::where('exam_participants_id', $participant->id)->first();

        return view('admin.result.result', compact(
            'participant',
            'exam',
            'result'
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
        // Balik nilai is_correct
        $is_correct = $request->is_correct;

        if ($is_correct == 1) {
            $validated['is_correct'] = 0;
        } else {
            $validated['is_correct'] = 1;
        }
        // Temukan jawaban dan soal terkait
        $answer = Answer::findOrFail($id);
        $question = Questions::findOrFail($request->question_id);

        if ($validated['is_correct'] == 0) {
            $answer->update([
                'is_correct' => $validated['is_correct'],
                'point' => '0',
            ]);
        } else {
            $answer->update([
                'is_correct' => $validated['is_correct'],
                'point' => $question->point,
            ]);
        }

        // Cari participant
        $participant = Exam_participants::where('user_id', $request->user_id)
            ->where('exams_id', $request->exams_id)
            ->firstOrFail();

        // Hitung ulang total point semua jawaban benar
        $totalPoint = Answer::where('exam_participants_id', $participant->id)
            ->where('is_correct', 1)
            ->sum('point');

        // Update ke tabel peserta
        $participant->update([
            'end_date' => now(),
            'status' => 'Finish',
            'point' => $totalPoint,
        ]);
        return redirect()->back()->with('success', 'Status jawaban berhasil dibalik.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
