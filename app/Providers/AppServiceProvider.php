<?php

namespace App\Providers;

use App\Repositories\ExamRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\CourseRepository;
use App\Repositories\NoticeRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\RoutineRepository;
use App\Repositories\SectionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ExamRuleRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\SyllabusRepository;
use App\Repositories\GradeRuleRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\AssignmentRepository;
use App\Repositories\AttendanceRepository;
use App\Repositories\PermissionRepository;
use App\Services\Repositories\ExamService;
use App\Services\Repositories\RoleService;
use App\Services\Repositories\UserService;
use App\Repositories\SchoolClassRepository;
use App\Contracts\Repositories\ExamContract;
use App\Contracts\Repositories\RoleContract;
use App\Contracts\Repositories\UserContract;
use App\Services\Repositories\CourseService;
use App\Services\Repositories\NoticeService;
use App\Repositories\GradingSystemRepository;
use App\Repositories\SchoolSessionRepository;
use App\Services\Repositories\ProfileService;
use App\Services\Repositories\RoutineService;
use App\Services\Repositories\SectionService;
use App\Contracts\Repositories\CourseContract;
use App\Contracts\Repositories\NoticeContract;
use App\Services\Repositories\ExamRuleService;
use App\Services\Repositories\SemesterService;
use App\Services\Repositories\SyllabusService;
use App\Contracts\Repositories\ProfileContract;
use App\Contracts\Repositories\RoutineContract;
use App\Contracts\Repositories\SectionContract;
use App\Repositories\AssignedTeacherRepository;
use App\Services\Repositories\GradeRuleService;
use App\Services\Repositories\PromotionService;
use App\Contracts\Repositories\ExamRuleContract;
use App\Contracts\Repositories\SemesterContract;
use App\Contracts\Repositories\SyllabusContract;
use App\Services\Repositories\AssignmentService;
use App\Services\Repositories\AttendanceService;
use App\Services\Repositories\PermissionService;
use App\Contracts\Repositories\GradeRuleContract;
use App\Contracts\Repositories\PromotionContract;
use App\Services\Repositories\SchoolClassService;
use App\Contracts\Repositories\AssignmentContract;
use App\Contracts\Repositories\AttendanceContract;
use App\Contracts\Repositories\PermissionContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Services\Repositories\GradingSystemService;
use App\Services\Repositories\SchoolSessionService;
use App\Contracts\Repositories\GradingSystemContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Services\Repositories\AssignedTeacherService;
use App\Contracts\Repositories\AssignedTeacherContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // School Session
        $this->app->bind(SchoolSessionService::class, function () {
            return new SchoolSessionService(new SchoolSessionRepository());
        });
        $this->app->bind(SchoolSessionContract::class, SchoolSessionService::class);

        // Semester
        $this->app->bind(SemesterService::class, function () {
            return new SemesterService(new SemesterRepository());
        });
        $this->app->bind(SemesterContract::class, SemesterService::class);

        // School Class
        $this->app->bind(SchoolClassService::class, function () {
            return new SchoolClassService(new SchoolClassRepository());
        });
        $this->app->bind(SchoolClassContract::class, SchoolClassService::class);

        // Section
        $this->app->bind(SectionService::class, function () {
            return new SectionService(new SectionRepository());
        });
        $this->app->bind(SectionContract::class, SectionService::class);

        // Course
        $this->app->bind(CourseService::class, function () {
            return new CourseService(new CourseRepository());
        });
        $this->app->bind(CourseContract::class, CourseService::class);

        // Assigned Teacher
        $this->app->bind(AssignedTeacherService::class, function () {
            return new AssignedTeacherService(new AssignedTeacherRepository());
        });
        $this->app->bind(AssignedTeacherContract::class, AssignedTeacherService::class);

        // Attendance
        $this->app->bind(AttendanceService::class, function () {
            return new AttendanceService(new AttendanceRepository());
        });
        $this->app->bind(AttendanceContract::class, AttendanceService::class);

        // Assignment
        $this->app->bind(AssignmentService::class, function () {
            return new AssignmentService(new AssignmentRepository());
        });
        $this->app->bind(AssignmentContract::class, AssignmentService::class);

        // Syllabus
        $this->app->bind(SyllabusService::class, function () {
            return new SyllabusService(new SyllabusRepository());
        });
        $this->app->bind(SyllabusContract::class, SyllabusService::class);

        // Routine
        $this->app->bind(RoutineService::class, function () {
            return new RoutineService(new RoutineRepository());
        });
        $this->app->bind(RoutineContract::class, RoutineService::class);

        // Exam
        $this->app->bind(ExamService::class, function () {
            return new ExamService(new ExamRepository());
        });
        $this->app->bind(ExamContract::class, ExamService::class);

        // Exam Rule
        $this->app->bind(ExamRuleService::class, function () {
            return new ExamRuleService(new ExamRuleRepository());
        });
        $this->app->bind(ExamRuleContract::class, ExamRuleService::class);

        // Grades
        $this->app->bind(GradingSystemService::class, function () {
            return new GradingSystemService(new GradingSystemRepository());
        });
        $this->app->bind(GradingSystemContract::class, GradingSystemService::class);

        // Grade Rule
        $this->app->bind(GradeRuleService::class, function () {
            return new GradeRuleService(new GradeRuleRepository());
        });
        $this->app->bind(GradeRuleContract::class, GradeRuleService::class);

        // Promotion
        $this->app->bind(PromotionService::class, function () {
            return new PromotionService(new PromotionRepository());
        });
        $this->app->bind(PromotionContract::class, PromotionService::class);

        // Notice
        $this->app->bind(NoticeService::class, function () {
            return new NoticeService(new NoticeRepository());
        });
        $this->app->bind(NoticeContract::class, NoticeService::class);



        // Profile
        $this->app->bind(ProfileService::class, function () {
            return new ProfileService(new ProfileRepository());
        });
        $this->app->bind(ProfileContract::class, ProfileService::class);

        // Roles
        $this->app->bind(RoleService::class, function () {
            return new RoleService(new RoleRepository());
        });
        $this->app->bind(RoleContract::class, RoleService::class);

        // Permissions
        $this->app->bind(PermissionService::class, function () {
            return new PermissionService(new PermissionRepository());
        });
        $this->app->bind(PermissionContract::class, PermissionService::class);

        // Users
        $this->app->bind(UserService::class, function () {
            return new UserService(new UserRepository(new PromotionRepository()));
        });
        $this->app->bind(UserContract::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
