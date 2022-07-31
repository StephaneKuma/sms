<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\AttendanceContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\UserContract;
use App\Models\AssignedTeacher;
use App\Models\Attendance;
use App\Models\Setting;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use SchoolSession;

    public function __construct(
        private AttendanceContract $service,
        private SchoolSessionContract $sessionService,
        private UserContract $userService
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
     * Show the form for creating a new resource.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function create(AssignedTeacher $assignedTeacher)
    {
        $setting = Setting::all()->last();
        $promotionStudentsData = $this->userService->getPromotionStudentsDataByClassAndSection($assignedTeacher->session_id, $assignedTeacher->class_id, $assignedTeacher->section_id);

        $attendanceCount = 0;

        if ($setting->attendance_type == 'section') {
            $attendanceCount = $this->service->getSectionAttendance($assignedTeacher->class_id, $assignedTeacher->section_id, $assignedTeacher->session_id)->count();
        } else {
            $attendanceCount = $this->service->getCourseAttendance($assignedTeacher->class_id, $assignedTeacher->course_id, $assignedTeacher->session_id)->count();
        }

        return view('attendances.form', compact('assignedTeacher', 'setting', 'promotionStudentsData', 'attendanceCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service->saveAttendance($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedTeacher $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedTeacher $assignedTeacher)
    {
        $setting = Setting::all()->last();
        $attendances = [];

        if ($setting->attendance_type == 'section') {
            $attendances = $this->service->getSectionAttendance($assignedTeacher->class_id, $assignedTeacher->section_id, $assignedTeacher->session_id);
        } else {
            $attendances = $this->service->getCourseAttendance($assignedTeacher->class_id, $assignedTeacher->course_id, $assignedTeacher->session_id);
        }

        return view('attendances.show', compact('assignedTeacher', 'attendances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
