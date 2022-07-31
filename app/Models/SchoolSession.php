<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolSession extends Model
{
    use HasFactory;

    /**
     * Array of attributes may be set through mass assignment to the model,
     * and all others will just get ignored for security reasons.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the semesters for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class, 'session_id', 'id');
    }

    /**
     * Get all of the classes for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class, 'session_id', 'id');
    }

    /**
     * Get all of the sections for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'session_id', 'id');
    }

    /**
     * Get all of the courses for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'session_id', 'id');
    }

    /**
     * Get all of the syllabi for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syllabi(): HasMany
    {
        return $this->hasMany(Syllabus::class, 'session_id', 'id');
    }

    /**
     * Get all of the promotions for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class, 'session_id', 'id');
    }

    /**
     * Get all of the exams for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'session_id', 'id');
    }

    /**
     * Get all of the examRules for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examRules(): HasMany
    {
        return $this->hasMany(ExamRule::class, 'session_id', 'id');
    }

    /**
     * Get all of the marks for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class, 'session_id', 'id');
    }

    /**
     * Get all of the gradingSystems for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradingSystems(): HasMany
    {
        return $this->hasMany(GradingSystem::class, 'session_id', 'id');
    }

    /**
     * Get all of the gradeRules for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeRules(): HasMany
    {
        return $this->hasMany(GradeRule::class, 'session_id', 'id');
    }

    /**
     * Get all of the notices for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class, 'session_id', 'id');
    }

    /**
     * Get all of the events for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'session_id', 'id');
    }

    /**
     * Get all of the assignedTeachers for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedTeachers(): HasMany
    {
        return $this->hasMany(AssignedTeacher::class, 'session_id', 'id');
    }

    /**
     * Get all of the attendances for the SchoolSession
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'session_id', 'id');
    }
}
