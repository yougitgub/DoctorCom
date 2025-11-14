<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'title' => 'Cardiac Consultation',
            'description' => 'Comprehensive heart health evaluation and treatment planning',
            'icon' => 'fas fa-heartbeat',
            'order' => 1,
        ]);

        Service::create([
            'title' => 'Preventive Care',
            'description' => 'Regular check-ups and health screenings',
            'icon' => 'fas fa-shield-alt',
            'order' => 2,
        ]);

        Service::create([
            'title' => 'Emergency Care',
            'description' => '24/7 urgent medical assistance',
            'icon' => 'fas fa-ambulance',
            'order' => 3,
        ]);
    }
}