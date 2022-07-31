<?php

namespace App\Services\Repositories;

use Illuminate\Http\Request;
use App\Repositories\AttendanceRepository;
use App\Contracts\Repositories\AttendanceContract;

class AttendanceService implements AttendanceContract
{
    public function __construct(private AttendanceRepository $repository)
    {
    }

    /**
     * Create or update an instance of the Attendance model.
     *
     * @param Request $request
     * @return bool
     */
    public function saveAttendance(Request $request)
    {
        return $this->repository->saveAttendance($request);
    }

    public function getSectionAttendance($classId, $sectionId, $sessionId)
    {
        return $this->repository->getSectionAttendance($classId, $sectionId, $sessionId);
    }

    public function getCourseAttendance($classId, $courseId, $sessionId)
    {
        return $this->repository->getCourseAttendance($classId, $courseId, $sessionId);
    }

    public function getStudentAttendance($sessionId, $studentId)
    {
        return $this->repository->getStudentAttendance($sessionId, $studentId);
    }
}
