<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ExamRuleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\SchoolSessionController;
use App\Http\Controllers\SettingController;

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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // School
    Route::prefix('school')->name('school.')->group(function () {
        // Semesters
        Route::resource('semesters', SemesterController::class)->except('show');

        // Classes
        Route::resource('classes', SchoolClassController::class)->except('show');

        // Sections
        Route::resource('sections', SectionController::class)->except('show');

        // Courses
        Route::resource('courses', CourseController::class)->except('show');
        Route::get('courses/by_class', [CourseController::class, 'getByClassId'])->name('courses.by.class.id');

        // Syllabi
        Route::resource('syllabi', SyllabusController::class)->except('show');

        // Promotions
        Route::resource('promotions', PromotionController::class)->except('show');

        // Exams & Grades
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
        });
    });

    // Settings
    Route::resource('settings', SettingController::class)->except(['show', 'create', 'destroy']);
    Route::prefix('settings')->name('settings.')->group(function () {
        // Sessions
        Route::resource('sessions', SchoolSessionController::class)->except('show');
        Route::post('sessions/browse', [SchoolSessionController::class, 'browse'])->name('sessions.browse');

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

require __DIR__.'/auth.php';
