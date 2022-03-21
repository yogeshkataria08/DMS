<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@adminer.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'role' => '1',
            'remember_token' => Str::random(10),
        ]);
    }
}
