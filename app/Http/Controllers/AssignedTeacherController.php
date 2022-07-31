<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Models\AssignedTeacher;
use App\Http\Requests\StoreAssignedTeacherRequest;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\SemesterContract;
use App\Services\Repositories\AssignedTeacherService;

class AssignedTeacherController extends Controller
{
    use SchoolSession;

    /**
     * Create a new instance of the class
     *
     * @param AssignedTeacherService $service
     */
    public function __construct(
        private AssignedTeacherService $service,
        private SchoolSessionContract $sessionService,
        private SemesterContract $semesterService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $teacher
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTeacherCourses(User $teacher, Request $request)
    {
        $semesterId = $request->query('semester_id');

        abort_if($teacher == null, 404);

        $semesters = $this->semesterService->getAllBySession($this->getCurrentSchoolSession());
        $assignedTeacherData = [];

        if ($semesterId != null) {
            $assignedTeacherData = $this->service->getTeacherData($this->getCurrentSchoolSession(), $teacher->id, $semesterId);
        }

        return view('settings.courses.teacher', compact('assignedTeacherData', 'semesters', 'semesterId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAssignedTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignedTeacherRequest $request)
    {
        $this->service->create($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedTeacher $assignedTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedTeacher $assignedTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreAssignedTeacherRequest  $request
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignedTeacher $assignedTeacher)
    {
        $this->service->update($request, $assignedTeacher);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignedTeacher $assignedTeacher)
    {
        $this->service->delete($assignedTeacher);

        return back();
    }
}
