<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routine extends Model
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
        'class_id',
        'section_id',
        'course_id',
        'weekday',
        'start_at',
        'end_at',
    ];

    /**
     * Get the session that owns the Routine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    /**
     * Get the class that owns the Routine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    /**
     * Get the section_id that owns the Routine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the course that owns the Routine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
