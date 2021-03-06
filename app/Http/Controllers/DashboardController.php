<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\NoticeContract;
use App\Contracts\Repositories\PromotionContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\UserContract;
use App\Models\User;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use SchoolSession;

    public function __construct(private SchoolSessionContract $sessionService,
        private UserContract $userService,
        private SchoolClassContract $classService,
        private PromotionContract $promotionService,
        private NoticeContract $noticeService)
    {}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sessionId = $this->getCurrentSchoolSession();

        $studentCount = $this->userService->getStudents($sessionId)->count();

        $teacherCount = $this->userService->getTeachers()->count();

        $classCount = $this->classService->getAllBySession($sessionId)->count();

        $maleStudents = $this->promotionService->getMaleStudentsBySession($sessionId);

        $notices = $this->noticeService->getAllWithPagination($sessionId, 3);

        return view('dashboard', compact('studentCount', 'teacherCount', 'classCount', 'maleStudents', 'notices'));
    }
}
