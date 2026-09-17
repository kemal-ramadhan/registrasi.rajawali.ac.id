<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Exams;
use App\Models\Exam_lisan;
use App\Models\Exam_participants;
use App\Models\ProgramOption;
use App\Models\Questions;
use App\Models\Choices_question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Mahasiswa;

class SeleksiMabaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programOptions = ProgramOption::select(
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
            ->where('program_options.user_id', Auth::id()) // Menggunakan user yang sedang login
            ->get();
        return view('customer.seleksi.mytest', compact('programOptions'));
    }
    public function indexDetailTest($id)
    {
        $userId = Auth::id(); // ambil user yang sedang login

        $exams = Exams::where('registration_path_id', $id)
            ->where('status', 'publish')
            ->with('registration_path.programOptions.departement') // eager load sampai ke departement
            ->get();

        return view('customer.seleksi.index', compact('exams'));
    }

    public function bantuan()
    {
        return view('customer.bantuan.index');
    }

    public function question($id, $questionNumber = 1)
    {
        $questionLists = Questions::where('exams_id', $id)->get();
        $currentQuestion = $questionLists->skip($questionNumber - 1)->first();

        if (!$currentQuestion) {
            abort(404, 'Soal tidak ditemukan.');
        }

        $choices = Choices_question::all();

        $participant = Exam_participants::where('user_id', Auth::id())
            ->where('exams_id', $id)
            ->first();

        $participantId = $participant->id;
        $userAnswer = Answer::where('exam_participants_id', $participantId)
            ->where('questions_id', $currentQuestion->id)
            ->first();

        $exam = Exams::findOrFail($id);

        $startDate = $participant->start_date;
        $durationMinutes = $exam->duration;

        return view('customer.seleksi.question', compact(
            'questionLists',
            'currentQuestion',
            'choices',
            'userAnswer',
            'id',
            'exam',
            'questionNumber',
            'startDate',
            'durationMinutes'
        ));
    }

    public function indexResult($id)
    {
        $participant = Exam_participants::with(['answers.question', 'answers.choice']) // eager load
            ->where('user_id', Auth::id())
            ->where('exams_id', $id)
            ->firstOrFail();

        $exam = Exams::findOrFail($id);

        $answers = $participant->answers;

        $correctAnswers = $answers->where('is_correct', true)->count();
        $totalQuestions = Questions::where('exams_id', $id)->count();

        // Total skor peserta
        $totalPoint = $answers->sum('point');

        // Total maksimal skor ujian (misalnya tiap soal 1 poin)
        $maxPoint = Questions::where('exams_id', $id)->sum('point');

        return view('customer.seleksi.result', compact(
            'participant',
            'exam',
            'answers',
            'correctAnswers',
            'totalQuestions',
            'totalPoint',
            'maxPoint'
        ));
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
        // Validasi input
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'token' => 'required|string|unique:exam_participants,token',
        ]);

        // Cek apakah user sudah terdaftar untuk exam yang sama
        $existing = Exam_participants::where('exams_id', $validated['exams_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->route('test.question', $validated['exams_id'])
                ->with('error', 'Kamu sudah terdaftar di ujian ini. Silakan lanjutkan.');
        }

        // Simpan peserta baru
        $participant = Exam_participants::create([
            'exams_id'   => $validated['exams_id'],
            'user_id'    => Auth::id(),
            'token'      => $validated['token'],
            'start_date' => now(),
            'end_date'   => null,
            'point'      => null,
        ]);

        return redirect()->route('test.question', $validated['exams_id'])
            ->with('success', 'Ujian dimulai, semangat!');
    }

    public function storeGabung(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'token' => 'required|string|unique:exam_participants,token',
        ]);

        // Cek apakah user sudah terdaftar untuk exam yang sama
        $existing = Exam_participants::where('exams_id', $validated['exams_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Kamu sudah terdaftar di ujian ini. Silakan lanjutkan.');
        }

        // Simpan peserta baru
        $participant = Exam_participants::create([
            'exams_id'   => $validated['exams_id'],
            'user_id'    => Auth::id(),
            'token'      => $validated['token'],
            'start_date' => now(),
            'end_date'   => null,
            'point'      => null,
            'status'      => 'Bergabung',
        ]);

        return redirect()->back()
            ->with('success', 'Data Sudah Tersimpan, Silahkan bergabung di ujian, semangat!');
    }

    public function storeAnswer(Request $request, $examId, $questionNumber)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required',
        ]);

        $participant = Exam_participants::where('user_id', Auth::id())
            ->where('exams_id', $examId)
            ->firstOrFail();

        $question = Questions::findOrFail($request->question_id);
        $answerValue = $request->answer;
        $isCorrect = null;
        $point = null;

        if ($question->type === 'pilihan_ganda') {
            $choice = Choices_question::find($answerValue);
            if ($choice) {
                $isCorrect = $choice->is_correct;
                $point = $choice->is_correct ? $question->point : 0;
            }
        } elseif (in_array($question->type, ['esai', 'jawaban_singkat'])) {
            $point = null;
            $isCorrect = null;
        }

        Answer::updateOrCreate(
            [
                'exam_participants_id' => $participant->id,
                'questions_id' => $question->id,
            ],
            [
                'answer' => $answerValue,
                'is_correct' => $isCorrect,
                'point' => $point,
            ]
        );

        // Cek apakah ini soal terakhir
        $totalQuestions = Questions::where('exams_id', $examId)->count();
        if ($questionNumber >= $totalQuestions) {
            // Soal terakhir → redirect kembali & munculkan alert
            return redirect()->route('test.question', [$examId, $questionNumber])
                ->with('done', 'Ujian telah selesai. Jawaban terakhir berhasil disimpan!');
        }

        // Jika belum soal terakhir → lanjut ke soal berikutnya
        return redirect()->route('test.question', [$examId, $questionNumber + 1]);
    }

    public function storeFinish(Request $request)
    {
        $participant = Exam_participants::where('user_id', Auth::id())
            ->where('exams_id', $request->exams_id)
            ->firstOrFail();

        // Ambil semua jawaban peserta yang benar
        $totalPoint = Answer::where('exam_participants_id', $participant->id)
            ->where('is_correct', 1)
            ->sum('point'); // jumlah total point dari jawaban yang benar

        // Update end_date, status, dan point ke tabel participant
        $participant->update([
            'end_date' => now(),
            'status' => 'Finish',
            'point' => $totalPoint,
        ]);

        return redirect()->route('test.result', $request->exams_id)
            ->with('success', 'Ujian telah selesai');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exams::where('id', $id)
            ->with('registration_path.programOptions.departement')
            ->first();

        $participant = Exam_participants::where('user_id', Auth::id())
            ->where('exams_id', $id)
            ->first();

        if ($exam->pengerjaan === 'Terjadwal') {
            $now = Carbon::now();
            $startDate = Carbon::parse($exam->start_date);

            // Hanya jika waktu ujian belum dimulai
            if ($now->lt($startDate)) {
                return back()->with('error', 'Ujian belum dimulai. Silakan cek kembali jadwal Anda.');
            }

            // Render view berdasarkan tipe ujian
            if ($exam->type == 'Lisan') {
                $lisan = Exam_lisan::where('exams_id', $id)->first();
                return view('customer.seleksi.lisan', compact('exam', 'lisan', 'participant'));
            } else {
                return view('customer.seleksi.show', compact('exam', 'participant'));
            }
        }

        // Render view berdasarkan tipe ujian
        if ($exam->type == 'Lisan') {
            $lisan = Exam_lisan::where('exams_id', $id)->first();
            return view('customer.seleksi.lisan', compact('exam', 'lisan', 'participant'));
        } else {
            return view('customer.seleksi.show', compact('exam', 'participant'));
        }
    }


    public function showHasil(string $id)
    {

        $participant = Exam_participants::find($id);
        $result = Result::where('exam_participants_id', $participant->id)->first();
        $exam = Exams::findOrFail($participant->exams_id);
        $mahasiswa = Mahasiswa::where('user_id', $participant->user_id)->first();
        return view('customer.seleksi.hasil', compact('result', 'participant', 'exam', 'mahasiswa'));
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
