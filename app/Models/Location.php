<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['location_name', 'address', 'postcode', 'city', 'house_number', 'state', 'country', 'lat', 'long'];

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
