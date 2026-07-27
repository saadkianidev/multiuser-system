<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',

            'view companies',
            'create companies',
            'edit companies',
            'delete companies',

            'view conversations',
            'create conversations',
            'send messages',

            'access super-admin dashboard',
            'access admin dashboard',
            'access employee dashboard',
            'access guest dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'view users', 'create users', 'edit users', 'delete users',
            'view companies', 'edit companies',
            'view conversations', 'create conversations', 'send messages',
            'access admin dashboard',
        ]);

        $employee = Role::firstOrCreate(['name' => 'employee']);
        $employee->givePermissionTo([
            'view conversations', 'create conversations', 'send messages',
            'access employee dashboard',
        ]);

        $guest = Role::firstOrCreate(['name' => 'guest']);
        $guest->givePermissionTo([
            'view conversations', 'send messages',
            'access guest dashboard',
        ]);
    }
}