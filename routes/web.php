<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // School
    Route::prefix('school')->name('school.')->group(function () {
        // Session
        Route::resource('sessions', SchoolSessionController::class);
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
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
