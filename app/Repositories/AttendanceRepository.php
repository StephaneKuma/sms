<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\AttendanceContract;
use App\Models\Attendance;

class AttendanceRepository implements AttendanceContract
{
    /**
     * Create or update an instance of the Attendance model.
     *
     * @param Request $request
     * @return bool
     */
    public function saveAttendance(Request $request)
    {
        $data = $this->prepareData($request);

        foreach ($data as $entry) {
            Attendance::updateOrCreate($entry);
        }

        toastr()->success('Les présences ont bien été enregistrées', 'Présences - Cours');

        return true;
    }

    public function getSectionAttendance($classId, $sectionId, $sessionId)
    {
        return Attendance::with('student')
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->where('session_id', $sessionId)
            ->whereDate('created_at', '=', Carbon::today())
            ->get();
    }

    public function getCourseAttendance($classId, $courseId, $sessionId)
    {
        return Attendance::with('student')
            ->where('class_id', $classId)
            ->where('course_id', $courseId)
            ->where('session_id', $sessionId)
            ->whereDate('created_at', '=', Carbon::today())
            ->get();
    }

    public function getStudentAttendance($sessionId, $studentId)
    {
        return Attendance::with(['section', 'course'])
            ->where('student_id', $studentId)
            ->where('session_id', $sessionId)
            ->get();
    }

    public function prepareData(Request $request)
    {
        $data = [];
        $now = Carbon::now()->toDateTimeString();
        for ($i = 0; $i < sizeof($request['student_ids']); $i++) {
            $studentId = $request['student_ids'][$i];
            $status = (isset($request['status'][$studentId])) ? $request['status'][$studentId] : 'off';
            $sectionId = $request['section_id'] == 'null' ? null : $request['section_id'];
            $courseId = $request['course_id'] == 'null' ? null : $request['course_id'];

            $data[] = [
                'status'        => $status,
                'class_id'      => $request['class_id'],
                'student_id'    => $studentId,
                'section_id'    => $sectionId,
                'course_id'     => $courseId,
                'session_id'    => $request['session_id'],
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }
        return $data;
    }
}
