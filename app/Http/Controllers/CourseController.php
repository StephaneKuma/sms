<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreCourseRequest;
use App\Contracts\Repositories\CourseContract;
use App\Contracts\Repositories\PromotionContract;
use App\Contracts\Repositories\SemesterContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Promotion;
use App\Models\User;

class CourseController extends Controller
{
    use SchoolSession;

    public function __construct(private CourseContract $service,
        private SchoolSessionContract $sessionService,
        private SemesterContract $semesterService,
        private SchoolClassContract $classService,
        private PromotionContract $promotionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('settings.courses.index', compact('courses'));
    }

    public function getStudentCourses(User $student)
    {
        $sessionId = $this->getCurrentSchoolSession();
        $promotion = $this->promotionService->getByStudent($sessionId, $student->id);
        $courses = $this->service->getAllByClassId($promotion->class_id);

        return view('students.courses', compact('promotion', 'courses'));
    }

    /**
     * get all the model from database by class id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByClassId(Request $request)
    {
        $classId = $request->query('class_id', 0);
        $courses = $this->service->getAllByClassId($this->getCurrentSchoolSession(), $classId);

        return response()->json(compact('courses'));
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

        return view('settings.courses.form', compact('sessionId', 'semesters', 'classes'));
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

        return back();
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

        return view('settings.courses.form', compact('course', 'sessionId', 'semesters', 'classes'));
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

        return back();
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
