<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreSyllabusRequest;
use App\Http\Requests\UpdateSyllabusRequest;
use App\Contracts\Repositories\CourseContract;
use App\Contracts\Repositories\SyllabusContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;

class SyllabusController extends Controller
{
    use SchoolSession;

    public function __construct(private SyllabusContract $service,
        private SchoolSessionContract $sessionService,
        private SchoolClassContract $classService,
        private CourseContract $courseService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syllabi = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('syllabi.index', compact('syllabi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = $this->sessionService->getAllWithClassesAndCourses();

        return view('syllabi.form', compact('sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSyllabusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSyllabusRequest $request)
    {
        $this->service->create($request, $this->getCurrentSchoolSession());

        return redirect()->route('school.syllabi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function show(Syllabus $syllabus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function edit(Syllabus $syllabus)
    {
        $sessions = $this->sessionService->getAllWithClassesAndCourses();

        return view('syllabi.form', compact('syllabus', 'sessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSyllabusRequest  $request
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSyllabusRequest $request, Syllabus $syllabus)
    {
        $this->service->update($request, $syllabus, $this->getCurrentSchoolSession());

        return redirect()->route('school.syllabi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syllabus $syllabus)
    {
        $this->service->delete($syllabus);

        return back();
    }
}
