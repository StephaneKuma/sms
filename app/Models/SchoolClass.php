<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClass extends Model
{
    use HasFactory;

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
        return $this->hasMany(SYllabus::class, 'class_id', 'id');
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
}
