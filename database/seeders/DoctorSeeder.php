<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        Doctor::firstOrCreate(['id' => 1], [
            'name' => 'Dr. Default Doctor',
            'specialty' => 'General Practice',
            'email' => 'doctor@doctorcom.com',
            'phone' => 'N/A',
            'bio' => 'Your default doctor profile.',
        ]);
    }
}