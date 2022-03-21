<?php

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'role'=> 'Super Admin'
        ]);

        UserRole::create([
            'role'=> 'User Admin'
        ]);

        UserRole::create([
            'role'=> 'Sales Team'
        ]);
    }
}
