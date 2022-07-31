<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
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
        'establish_date',
        'address',
        'email',
        'phone',
        'phone2',
        'fax',
        'logo',
        'attendance_type',
        'mark_submission_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //         'mark_submission_status' => 'boolean'
    //     ];
}
