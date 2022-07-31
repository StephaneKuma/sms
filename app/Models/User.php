<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'nationality',
        'phone',
        'address',
        'address2',
        'city',
        'zip',
        'picture',
        'birthday',
        'blood_type',
        'religion',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the promotions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotions::class, 'student_id', 'id');
    }

    /**
     * Get all of the assignedTeachers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedTeachers(): HasMany
    {
        return $this->hasMany(AssignedTeacher::class, 'teacher_id', 'id');
    }

    /**
     * Get all of the attendances for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id', 'id');
    }
}
