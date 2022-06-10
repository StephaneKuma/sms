<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreCourseRequest;
use App\Contracts\Repositories\CourseContract;
use App\Contracts\Repositories\SemesterContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    use SchoolSession;

    public function __construct(private CourseContract $service,
        private SchoolSessionContract $sessionService,
        private SemesterContract $semesterService,
        private SchoolClassContract $classService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionId = $this->getCurrentSchoolSession();
        $semesters = $this->semesterService->getAllBySession($sessionId);
        $classes = $this->classService->getAllBySession($sessionId);

        return view('courses.form', compact('sessionId', 'semesters', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $sessionId = $this->getCurrentSchoolSession();
        $semesters = $this->semesterService->getAllBySession($sessionId);
        $classes = $this->classService->getAllBySession($sessionId);

        return view('courses.form', compact('course', 'sessionId', 'semesters', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->service->update($request, $course);

        return redirect()->route('school.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $this->service->delete($course);

        return back();
    }
}
