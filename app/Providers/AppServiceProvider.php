<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SemesterRepository;
use App\Repositories\PermissionRepository;
use App\Services\Repositories\RoleService;
use App\Services\Repositories\UserService;
use App\Repositories\SchoolClassRepository;
use App\Contracts\Repositories\RoleContract;
use App\Contracts\Repositories\UserContract;
use App\Repositories\SchoolSessionRepository;
use App\Services\Repositories\ProfileService;
use App\Services\Repositories\SemesterService;
use App\Contracts\Repositories\ProfileContract;
use App\Contracts\Repositories\SemesterContract;
use App\Services\Repositories\PermissionService;
use App\Services\Repositories\SchoolClassService;
use App\Contracts\Repositories\PermissionContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Services\Repositories\SchoolSessionService;
use App\Contracts\Repositories\SchoolSessionContract;

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
            return new UserService(new UserRepository());
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
