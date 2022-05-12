<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'end_time', 'is_approved', 'created_at', 'updated_at', 'company_id', 'course_id', 'user_id', 'location_id', 'student_quantity', 'completed_at'];
}
