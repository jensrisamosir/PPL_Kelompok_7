<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'dokter',
        ]);

        Role::create([
            'role_name' => 'asisten',
        ]);
        
        User::create([
            'name' => 'flora',
            'email' => 'williamstmrg31@gmail.com',
            'password' => Hash::make('flora123'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'william',
            'email' => 'william@gmail.com',
            'password' => Hash::make('william123'),
            'role_id' => 2
 
        ]);
    }
}