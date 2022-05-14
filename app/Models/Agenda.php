<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'is_approved', 'created_at', 'updated_at', 'company_id', 'course_id', 'teacher_id', 'location_id', 'student_quantity', 'completed_at'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'agenda_student')->withTimestamps()->withPivot('is_approved', 'comment');
    }

    public function getTextAttribute() {
        $text = $this->id . ' - ' . $this->course->title . ' - ' . $this->company->name . ' - ' . $this->completed_at;

        return $text;
    }
}
