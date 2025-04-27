<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_id', 'first_name', 'last_name', 'email', 'date_of_birth', 'degree', 'status'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
