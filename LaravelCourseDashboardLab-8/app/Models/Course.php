<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // course table fillable cols

    protected $fillable = [
        'user_id',
        'course_code',
        'course_name',
        'credit_hours',
        'semester',
    ];
}
