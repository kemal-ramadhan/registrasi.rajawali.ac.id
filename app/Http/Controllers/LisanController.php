<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\RegistrationPath;
use App\Models\Exam_lisan;

class LisanController extends Controller
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
    public function create()
    {
                
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'media' => 'required|string|max:255',
            'link' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Publish,Draf', // sesuaikan jika ada opsi status lain
        ]);

        Exam_lisan::create($validated);

        return redirect()->route('exam.show', $validated['exams_id'])->with('success', 'Data ujian lisan berhasil disimpan.');
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
        $registrations = RegistrationPath::all();
        $id = $id;
        $lisan = Exam_lisan::where('exams_id', $id)->first();
        return view('admin.exam.jadwal', compact('registrations', 'lisan', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'exams_id' => 'required|exists:exams,id',
            'media' => 'required|string|max:255',
            'link' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Publish,Draf',
        ]);

        $lisan = Exam_lisan::findOrFail($id);
        $lisan->update($validated);

        return redirect()->route('exam.show', $validated['exams_id'])->with('success', 'Data ujian lisan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
