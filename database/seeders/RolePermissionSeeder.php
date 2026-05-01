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
    // =========================
    // 1. CREATE ALL PERMISSIONS
    // =========================
    $permissions = [
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
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate([
            'name' => $permission,
            'guard_name' => 'web',
        ]);
    }

    // =========================
    // 2. DEFINE ROLES CLEARLY
    // =========================

    // SUPER ADMIN → EVERYTHING
    $superAdminPermissions = $permissions;

    // ADMIN → FULL SYSTEM ACCESS (same as super-admin here)
    $adminPermissions = $permissions;

    // COMPANY SURMAJOR → LIMITED MANAGEMENT
    $companyPermissions = [
        'view dashboard',
        'view students',
        'view student profile',
        'upload student document',
        'view student documents',
        'update student status',
    ];

    // KARANI → DATA ENTRY ONLY
    $karaniPermissions = [
        'view dashboard',
        'create student',
        'view students',
        'view student profile',
        'upload student document',
    ];

    // KATIBU → VIEW ONLY
    $katibuPermissions = [
        'view dashboard',
        'view students',
        'view student profile',
    ];

    // STUDENT → OWN DATA ONLY
    $studentPermissions = [
        'view dashboard',
        'view student profile',
    ];

    // =========================
    // 3. ASSIGN ROLES (IF ROLE IS...)
    // =========================

    $roles = [
        'super-admin' => $superAdminPermissions,
        'admin' => $adminPermissions,
        'company-surmajor' => $companyPermissions,
        'karani' => $karaniPermissions,
        'katibu' => $katibuPermissions,
        'student' => $studentPermissions,
    ];

    foreach ($roles as $roleName => $perms) {
        $role = Role::firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($perms);
    }

    // =========================
    // 4. DEFAULT USER
    // =========================
    $user = User::first();

    if ($user && !$user->hasAnyRole(['super-admin', 'admin', 'karani', 'katibu'])) {
        $user->assignRole('super-admin');
    }
}
    
}

