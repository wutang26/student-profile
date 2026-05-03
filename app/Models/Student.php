<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'force_number',
        'nida',
        'date_of_birth',
        'gender',

        'phone',
        'email',
        'address',

        'origin_region',
        'origin_district',
        'entry_region',

        'course',
        'company',
        'platoon',
        'year_of_study',

        'next_of_kin_name',
        'next_of_kin_phone',
        'next_of_kin_relationship',
        'next_of_kin_address',

        'photo',
        'status',
        'comment',
          // NEW FIELD
       'intake',
    ];

    //Relation to Student Document
    public function documents()
{
    return $this->hasMany(StudentDocument::class);
}

public function originRegion()
{
    return $this->belongsTo(Region::class, 'origin_region_id');
}

//Filter students By Intake
// public function scopeIntake($query, $intake)
// {
//     return $query->where('intake', $intake);
// }
}
