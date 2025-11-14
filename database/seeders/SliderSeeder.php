<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        Slider::create([
            'title' => 'Welcome to DoctorCom',
            'description' => 'Professional healthcare at your fingertips',
            'image' => 'sliders/slider1.jpg',
            'is_active' => true,
        ]);

        Slider::create([
            'title' => 'Expert Medical Care',
            'description' => 'Trusted by thousands of patients',
            'image' => 'sliders/slider2.jpg',
            'is_active' => true,
        ]);
    }
}