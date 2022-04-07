<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'location', 'contact_number', 'contact_email', 'active', 'description', 'picture'];

    public function teacherProfiles(){
        return $this->hasMany(TeacherProfile::class);
    }

    public function companyAdmin(){
        $user = User::query()->role('company admin')
            ->whereHas('teacherProfile', function($q) {
                return $q->where('company_id', $this->id);
            })
            ->first();

        return $user;
    }
}
