<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'force_number',
        'phone',
        'next_of_kin',
        'origin_region',
        'entry_region',
        'comment',
        'status',
        'photo',
    ];
}
