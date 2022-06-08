<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\SchoolSession;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::orderby('created_at', 'DESC')->get();

        return view('semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolSessions = SchoolSession::orderby('created_at', 'DESC')->get();

        return view('semesters.form', compact('schoolSessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSemesterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemesterRequest $request)
    {
        $validated = $request->validated();
        $start_at = Carbon::createFromFormat('d-m-Y', $validated['start_at'])->timestamp;
        $end_at = Carbon::createFromFormat('d-m-Y', $validated['end_at'])->timestamp;

        Semester::create([
            'session_id' => $validated['session_id'],
            'name' => $validated['name'],
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        toastr()->success("Le semestre a bien été créé", 'Semestres - Ecole');

        return redirect()->route('school.semesters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        $schoolSessions = SchoolSession::orderby('created_at', 'DESC')->get();

        return view('semesters.form', compact('semester', 'schoolSessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSemesterRequest  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        $validated = $request->validated();
        $start_at = Carbon::createFromFormat('d-m-Y', $validated['start_at'])->timestamp;
        $end_at = Carbon::createFromFormat('d-m-Y', $validated['end_at'])->timestamp;

        $semester->update([
            'session_id' => $validated['session_id'],
            'name' => $validated['name'],
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        toastr()->success("Le semestre a bien été mise à jour", 'Semestres - Ecole');

        return redirect()->route('school.semesters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        toastr()->success("Le semestre a bien supprimé", 'Semestres - Ecole');

        return back();
    }
}
