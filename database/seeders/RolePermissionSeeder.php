<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleEditor = Role::create(['name' => 'Editor']);
        $roleOfficer = Role::create(['name' => 'Officer']);
        $roleUser = Role::create(['name' => 'User']);
    }
}
