<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GradeRule extends Model
{
    use HasFactory;

    /**
     * Array of attributes may be set through mass assignment to the model,
     * and all others will just get ignored for security reasons.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mark',
        'grade',
        'start_at',
        'end_at',
        'session_id',
        'system_id',
    ];

    /**
     * Get the session that owns the GradeRule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    /**
     * Get the system that owns the GradeRule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function system(): BelongsTo
    {
        return $this->belongsTo(GradingSystem::class, 'system_id');
    }
}
