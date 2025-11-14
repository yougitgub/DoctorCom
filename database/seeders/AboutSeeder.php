<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run()
    {
        About::create([
            'content' => '<p>We are dedicated to providing exceptional healthcare services to our community. Our state-of-the-art facility and experienced medical team ensure you receive the best possible care.</p><p>With over 15 years of experience, Dr. Johnson specializes in preventive cardiology and interventional procedures. Our mission is to improve lives through compassionate, evidence-based medicine.</p>',
            'image' => 'about/clinic.jpg',
        ]);
    }
}