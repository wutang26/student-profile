<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function model(array $row)
    {
        return new Student([
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'force_number' => $row[3],
            'nida' => $row[4],
            'date_of_birth' => $row[5],
            'gender' => $row[6],
            'company' => $row[7],
            'platoon' => $row[8],
            'phone' => $row[9],
            'email' => $row[10],
            'address' => $row[11],
            'next_of_kin_name' => $row[12],
            'next_of_kin_phone' => $row[13],
            'next_of_kin_relationship' => $row[14],
            'next_of_kin_address' => $row[15],
            'origin_region' => $row[16],
            'origin_district' => $row[17],
            'entry_region' => $row[18],
        ]);
    }
}
