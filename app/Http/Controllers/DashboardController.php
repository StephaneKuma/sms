<?php

namespace App\Http\Controllers;

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
        private SchoolClassContract $classService)
    {}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $studentCount = $this->userService->getStudents()->count();

        $teacherCount = $this->userService->getTeachers()->count();

        $classCount = $this->classService->getAllBySession($this->getCurrentSchoolSession())->count();

        return view('dashboard', compact('studentCount', 'teacherCount', 'classCount'));
    }
}
