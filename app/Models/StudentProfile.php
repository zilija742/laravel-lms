<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'baptism_name', 'birth_place', 'candidate_number', 'driver_license_number', 'driver_license_category', 'driver_card_expire', 'code95_expire', 'vca_number', 'personal_number', 'company_id', 'user_id', 'birthday'
    ];

    /**
    * Get the teacher profile that owns the user.
    */
    public function student(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
