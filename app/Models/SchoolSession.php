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
}
