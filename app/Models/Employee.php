<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "first_name",
        "last_name",
        "other_name",
        "zip_code",
        "department_id",
        "state_id",
        "country_id",
        "city_id",
        "birthdate",
        "date_hired",
        "email",
        "address"
    ];

    protected $casts = [
        "birthdate" => 'datetime:Y-m-d',
        "date_hired" => 'datetime:Y-m-d'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
