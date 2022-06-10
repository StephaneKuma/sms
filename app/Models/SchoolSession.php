<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolSession extends Model
{
    use HasFactory;

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
}
