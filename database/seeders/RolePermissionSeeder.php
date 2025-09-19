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
        // Permissions
        $permissions = ['manage users','manage courses','view reports'];
        foreach($permissions as $perm){
            Permission::firstOrCreate(['name'=>$perm,'guard_name'=>'web']);
        }

        // Roles
        $roles = ['admin','trainer','trainee'];
        foreach($roles as $role){
            Role::firstOrCreate(['name'=>$role,'guard_name'=>'web']);
        }

        // Assign permissions
        Role::findByName('admin')->syncPermissions(Permission::all());
        Role::findByName('trainer')->syncPermissions(['manage courses']);
        Role::findByName('trainee')->syncPermissions(['view reports']);

        // Assign roles to users
        $admin = User::where('email','admin@admin.com')->first();
        if($admin) $admin->assignRole('admin');

        $trainer = User::where('email','trainer@trainer.com')->first();
        if($trainer) $trainer->assignRole('trainer');

        $trainee = User::where('email','trainee@trainee.com')->first();
        if($trainee) $trainee->assignRole('trainee');
    }
}
