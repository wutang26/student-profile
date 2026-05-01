<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        // public function run()
        // {
        //     Permission::firstOrCreate([
        //         'name' => 'apply loan',
        //         'guard_name' => 'web',
        //     ], [
        //         'module' => 'loan',
        //         'lable' => 'Apply Loan',
        //         'is_active' => 1,
        //         'description' => 'User can apply for loan'
        //     ]);
        // }

        public function run()
{
    $permissions = [
            [
                'name' => 'create student',
                'module' => 'student',
                'lable' => 'Create Student',
                'description' => 'User can register a new student',
            ],
            [
                'name' => 'view students',
                'module' => 'student',
                'lable' => 'View Students',
                'description' => 'User can view student list',
            ],
            [
                'name' => 'view student profile',
                'module' => 'student',
                'lable' => 'View Student Profile',
                'description' => 'User can view full student details',
            ],
            [
                'name' => 'edit profile',
                'module' => 'student',
                'lable' => 'Edit Student',
                'description' => 'User can edit student information',
            ],
            [
                'name' => 'delete student',
                'module' => 'student',
                'lable' => 'Delete Student',
                'description' => 'User can delete student records',
            ],
            [
                'name' => 'upload student document',
                'module' => 'student',
                'lable' => 'Upload Document',
                'description' => 'User can upload student documents',
            ],
            [
                'name' => 'view student documents',
                'module' => 'student',
                'lable' => 'View Documents',
                'description' => 'User can view student documents',
            ],
            [
                'name' => 'update student status',
                'module' => 'student',
                'lable' => 'Update Status',
                'description' => 'User can update student status (active/inactive)',
            ],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                [
                    'name' => $perm['name'],
                    'guard_name' => 'web',
                ],
                [
                    'module' => $perm['module'],
                    'lable' => $perm['lable'],
                    'is_active' => 1,
                    'description' => $perm['description'],
                ]
            );
        }
    }


}
