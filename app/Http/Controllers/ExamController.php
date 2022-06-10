<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Contracts\Repositories\ExamContract;
use App\Contracts\Repositories\CourseContract;
use App\Contracts\Repositories\SemesterContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;

class ExamController extends Controller
{
    use SchoolSession;

    public function __construct(private ExamContract $service,
        private SchoolSessionContract $sessionService,
        private SemesterContract $semesterService,
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
        $exams = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionId =  $this->getCurrentSchoolSession();
        $semesters = $this->semesterService->getAllBySession($sessionId);
        $classes = $this->classService->getAllWithCoursesBySession($sessionId);

        return view('exams.form', compact('sessionId', 'semesters', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.exams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $sessionId =  $this->getCurrentSchoolSession();
        $semesters = $this->semesterService->getAllBySession($sessionId);
        $classes = $this->classService->getAllWithCoursesBySession($sessionId);

        return view('exams.form', compact('exam', 'sessionId', 'semesters', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $this->service->update($request, $exam);

        return redirect()->route('school.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $this->service->delete($exam);

        return back();
    }
}
