<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // -------------------------
        // STUDENT SYSTEM PERMISSIONS
        // -------------------------
        $permissions = [
            // Dashboard
            'view dashboard',

            // Student management
            'create student',
            'view students',
            'view student profile',
            'edit student',
            'delete student',

            // Documents
            'upload student document',
            'view student documents',

            // Status
            'update student status',

            // System management
            'manage users',
            'manage roles',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // -------------------------
        // ROLES & PERMISSIONS
        // -------------------------
        $rolesPermissions = [

            // FULL ACCESS
            'super-admin' => Permission::all()->pluck('name')->toArray(),

            // SYSTEM ADMIN
            'admin' => [
                'view dashboard',
                'create student',
                'view students',
                'view student profile',
                'edit student',
                'delete student',
                'upload student document',
                'view student documents',
                'update student status',
                'manage users',
                'manage roles',
            ],

            // COMPANY LEVEL (limited management)
            'company-surmajor' => [
                'view dashboard',
                'view students',
                'view student profile',
                'upload student document',
                'view student documents',
                'update student status',
            ],

            // CLERK (data entry)
            'karani' => [
                'view dashboard',
                'create student',
                'view students',
                'view student profile',
                'upload student document',
            ],

            // OPTIONAL SUPPORT ROLE
            'katibu' => [
                'view dashboard',
                'view students',
                'view student profile',
            ],

            // STUDENT ROLE (SELF ACCESS ONLY)
            'student' => [
                'view dashboard',
                'view student profile',
            ],
        ];

        foreach ($rolesPermissions as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        // -------------------------
        // Assign default role
        // -------------------------
        $firstUser = User::first();

        if ($firstUser && !$firstUser->hasAnyRole(array_keys($rolesPermissions))) {
            $firstUser->assignRole('super-admin');
        }
    }
}
