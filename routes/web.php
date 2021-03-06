<?php

use App\Http\Controllers\AssignedTeacherController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExamRuleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeRuleController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\GradingSystemController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SchoolSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Route::post('download', [DownloadFileController::class, 'getFile'])->name('download');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // School
    Route::prefix('school')->name('school.')->group(function () {
        // Classes
        Route::resource('classes', SchoolClassController::class)->only(['index', 'edit']);

        // Teachers
        Route::resource('teachers', TeacherController::class)
            ->except(['show', 'destroy'])
            ->middleware('role:admin|teacher');

        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('{teacher}/courses', [AssignedTeacherController::class, 'getTeacherCourses'])->name('courses');

            // Attendance
            Route::prefix('attendances')->name('attendances.')->group(function () {
                Route::get('{assignedTeacher}', [AttendanceController::class, 'index'])->name('index');
                Route::get('{assignedTeacher}/take', [AttendanceController::class, 'create'])->name('create');
                Route::post('{assignedTeacher}', [AttendanceController::class, 'store'])->name('store');
                Route::get('{assignedTeacher}/view', [AttendanceController::class, 'show'])->name('show');
            });

            // Assignment
            Route::prefix('assignments')->name('assignments.')->group(function () {
                Route::get('{assignedTeacher}', [AssignmentController::class, 'index'])->name('index');
                Route::get('{assignedTeacher}/create', [AssignmentController::class, 'create'])->name('create');
                Route::post('{assignedTeacher}', [AssignmentController::class, 'store'])->name('store');
            });
        });

        // Students
        Route::resource('students', StudentController::class)
            ->except(['show', 'destroy'])
            ->middleware('role:admin|teacher');
        Route::get('courses/student/{student}', [CourseController::class, 'getStudentCourses'])->name('show.students.courses');

        // Syllabi
        Route::resource('syllabi', SyllabusController::class)->except('show');

        // Promotions
        Route::resource('promotions', PromotionController::class)->only('index');
        Route::get('promotions/promote', [PromotionController::class, 'create'])->name('promotions.create');
        Route::post('promotions/promote', [PromotionController::class, 'store'])->name('promotions.store');

        // Exams
        Route::resource('exams', ExamController::class)->except('show');

        // Exam Rules
        Route::prefix('exams')->name('exams.')->group(function () {
            // Route::resource('rules', ExamRuleController::class)->except('show');
            Route::get('{exam}/rules', [ExamRuleController::class, 'index'])->name('rules.index');
            Route::get('{exam}/rules/create', [ExamRuleController::class, 'create'])->name('rules.create');
            Route::post('{exam}/rules', [ExamRuleController::class, 'store'])->name('rules.store');
            Route::get('{exam}/rules/{rule}/edit', [ExamRuleController::class, 'edit'])->name('rules.edit');
            Route::patch('{exam}/rules/{rule}', [ExamRuleController::class, 'update'])->name('rules.update');
            Route::delete('rules/{rule}', [ExamRuleController::class, 'destroy'])->name('rules.destroy');

            // Grades
            Route::prefix('grading')->name('grading.')->group(function () {
                Route::resource('systems', GradingSystemController::class)->except('show');
                Route::prefix('systems')->name('systems.')->group(function () {
                    Route::get('{system}/rules', [GradeRuleController::class, 'index'])->name('rules.index');
                    Route::get('{system}/rules/create', [GradeRuleController::class, 'create'])->name('rules.create');
                    Route::post('{system}/rules', [GradeRuleController::class, 'store'])->name('rules.store');
                    Route::get('{system}/rules/{rule}/edit', [GradeRuleController::class, 'edit'])->name('rules.edit');
                    Route::patch('{system}/rules/{rule}', [GradeRuleController::class, 'update'])->name('rules.update');
                    Route::delete('rules/{rule}', [GradeRuleController::class, 'destroy'])->name('rules.destroy');
                });
            });
        });

        // Routines
        Route::resource('routines', RoutineController::class)->except('index');
        // Route::prefix('routines')->name('routines.')->group(function () {
        //     Route::get('create', [RoutineController::class, 'create'])->name('create');
        //     Route::post('', [RoutineController::class, 'store'])->name('store');
        //     Route::get('{routine}', [RoutineController::class, 'show'])->name('show');
        //     Route::get('{routine}/edit', [RoutineController::class, 'edit'])->name('edit');
        //     Route::post('{routine}', [RoutineController::class, 'update'])->name('update');
        //     Route::delete('{routine}', [RoutineController::class, 'destroy'])->name('destroy');
        // });

        // Notices
        Route::resource('notices', NoticeController::class)->only(['create', 'store']);

        // Events
        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::post('events-ajax', [EventController::class, 'store'])->name('events.ajax');
    });

    // Settings
    Route::resource('settings', SettingController::class)->except(['show', 'create', 'destroy']);
    Route::prefix('settings')->name('settings.')->group(function () {
        // Sessions
        Route::resource('sessions', SchoolSessionController::class)->except('show');
        Route::post('sessions/browse', [SchoolSessionController::class, 'browse'])->name('sessions.browse');

        // Semesters
        Route::resource('semesters', SemesterController::class)->except('show');

        // Classes
        Route::post('classes', [SchoolClassController::class, 'store'])->name('classes.store');
        Route::patch('classes/{class}', [SchoolClassController::class, 'update'])->name('classes.update');
        Route::delete('classes/{class}', [SchoolClassController::class, 'destroy'])->name('classes.destroy');
        Route::get('sections_and_courses/by_class', [SchoolClassController::class, 'getSectionsAndCoursesByClassId'])->name('courses.and.sections.by.class.id');

        // Sections
        Route::resource('sections', SectionController::class)->except(['show', 'index']);
        Route::get('sections/by_class', [SectionController::class, 'getByClassId'])->name('sections.by.class.id');

        // Courses
        Route::resource('courses', CourseController::class)->except('show');
        Route::get('courses/by_class', [CourseController::class, 'getByClassId'])->name('courses.by.class.id');

        // Assigned Teacher
        Route::resource('assignedTeachers', AssignedTeacherController::class)->except(['index', 'create', 'show']);

        // Profile
        Route::resource('profiles', ProfileController::class)->except(['index', 'create', 'store']);

        // ACL
        Route::prefix('acl')->name('acl.')->group(function () {
            // Roles
            Route::resource('roles', RoleController::class)->except('show');

            // Permissions
            Route::resource('permissions', PermissionController::class)->except('show');

            // Users
            Route::resource('users', UserController::class)->except('show');
        });
    });
});

require __DIR__ . '/auth.php';
