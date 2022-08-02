<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClass extends Model
{
    use HasFactory;

    /**
     * Array of attributes may be set through mass assignment to the model,
     * and all others will just get ignored for security reasons.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id',
        'name'
    ];

    /**
     * Get the session that owns the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    /**
     * Get all of the sections for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'class_id', 'id');
    }

    /**
     * Get all of the courses for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'class_id', 'id');
    }

    /**
     * Get all of the syllabi for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syllabi(): HasMany
    {
        return $this->hasMany(Syllabus::class, 'class_id', 'id');
    }

    /**
     * Get all of the promotions for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class, 'class_id', 'id');
    }

    /**
     * Get all of the exams for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'class_id', 'id');
    }

    /**
     * Get all of the marks for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class, 'class_id', 'id');
    }

    /**
     * Get all of the gradingSystems for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradingSystems(): HasMany
    {
        return $this->hasMany(GradingSystem::class, 'class_id', 'id');
    }

    /**
     * Get all of the assignedTeachers for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedTeachers(): HasMany
    {
        return $this->hasMany(AssignedTeacher::class, 'class_id', 'id');
    }

    /**
     * Get all of the attendances for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'class_id', 'id');
    }

    /**
     * Get all of the assignments for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'class_id', 'id');
    }

    /**
     * Get all of the routines for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class, 'class_id', 'id');
    }
}
