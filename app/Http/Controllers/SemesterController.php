<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\SemesterContract;
use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Traits\SchoolSession;

class SemesterController extends Controller
{
    use SchoolSession;

    /**
     * Create a new instance of the class.
     *
     * @param SemesterContract $service
     */
    public function __construct(private SemesterContract $service,
        private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('settings.semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('settings.semesters.form', compact('sessionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSemesterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemesterRequest $request)
    {
        $this->service->create($request);

        return back();
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
        $sessionId = $this->getCurrentSchoolSession();

        return view('settings.semesters.form', compact('semester', 'sessionId'));
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
        $this->service->update($request, $semester);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $this->service->delete($semester);

        return back();
    }
}
