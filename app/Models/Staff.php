<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

     protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'force_number',
        'rank',
        'department',
        'phone',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'staffs';
}
