<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    use HasFactory;
     protected $fillable = [
        'student_id',
        'type',
        'title',
        'file_path',
        'remarks' //Comments
    ];

    //Relationship to Student Model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
