<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'location', 'contact_number', 'contact_email', 'active', 'description', 'picture'];

    public function teacherProfiles(){
        return $this->hasMany(TeacherProfile::class);
    }
}
