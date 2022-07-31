<?php

namespace App\Contracts\Repositories;

use Illuminate\Foundation\Http\FormRequest;

interface AttendanceContract {
    /**
     * Create or update an instance of the Attendance model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function saveAttendance(FormRequest $request);

    public function getSectionAttendance($classId, $sectionId, $sessionId);

    public function getCourseAttendance($classId, $courseId, $sessionId);

    public function getStudentAttendance($sessionId, $studentId);
}
