<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $modules = [
            'User Management' => [
                'users_create',
                'users_view',
                'users_edit',
                'users_delete',
                'roles_create',
                'roles_view',
                'roles_edit',
                'roles_delete',
                'permissions_create',
                'permissions_view',
                'permissions_edit',
                'permissions_delete',
            ],
        ];

        foreach ($modules as $module => $childpermissions) {
            // Module Permissions [Parent_id or Module Name]
            $parent = Permission::firstOrCreate(['name' => $module, 'guard_name' => 'web']);

            // Child Permissions [Permission Name ]

            foreach ($childpermissions as $childperm) {
                Permission::firstOrCreate(['name' => $childperm, 'guard_name' => 'web', 'parent_id' => $parent->id]);
            }


            // Roles
            $roles = ['admin', 'trainer', 'trainee'];
            foreach ($roles as $role) {
                Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
            }

            // Assign permissions
            Role::findByName('admin')->syncPermissions(Permission::all());
            // Role::findByName('trainer')->syncPermissions(['manage courses']);
            // Role::findByName('trainee')->syncPermissions(['view reports']);

            // Assign roles to users
            $admin = User::where('email', 'admin@admin.com')->first();
            if ($admin) $admin->assignRole('admin');

            $trainer = User::where('email', 'trainer@trainer.com')->first();
            if ($trainer) $trainer->assignRole('trainer');

            $trainee = User::where('email', 'trainee@trainee.com')->first();
            if ($trainee) $trainee->assignRole('trainee');
        }
    }
}
