<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
//         User::create([
//     'name' => 'Admin',
//     'email' => 'admin@doctorcom.com',
//     'password' => bcrypt('password'),
//     'password' => Hash::make('password'),
//     'role' => 'admin',
// ]);

        // Run other seeders
        $this->call([
            DoctorSeeder::class,
            InitialDataSeeder::class,
        ]);
    }
}