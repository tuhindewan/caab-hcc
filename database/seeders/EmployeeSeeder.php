<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'designation' => 'Super Admin',
            'department' => 'Civil Aviation Authority of Bangladesh',
            'mobile' => '***********',
            'user_id' => 1,
        ]);
    }
}
