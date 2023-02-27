<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentList extends Model
{
    use HasFactory;
    protected $fillable =[
        'enrollment_id',
        'user_id',
        'status',
    ];
}
