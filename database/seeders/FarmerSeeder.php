<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Farmer::create(['name' => 'John Doe', 'phone' => '1234567890', 'village' => 'Village A']);
        \App\Models\Farmer::create(['name' => 'Jane Smith', 'phone' => '0987654321', 'village' => 'Village B']);
        \App\Models\Farmer::create(['name' => 'Bob Johnson', 'phone' => '1122334455', 'village' => 'Village C']);
    }
}
