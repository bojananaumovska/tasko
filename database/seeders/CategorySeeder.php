<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Tech Help'],
            ['name' => 'Delivery & Shopping'],
            ['name' => 'Cleaning'],
            ['name' => 'Moving & Hauling'],
            ['name' => 'Handyman Services'],
            ['name' => 'Pet Care'],
            ['name' => 'Yard Work'],
            ['name' => 'Event Help'],
            ['name' => 'Photography'],
            ['name' => 'Tutoring & Eduction'],
            ['name' => 'Senior Care'],
            ['name' => 'Virtual Assistance'],
            ['name' => 'Other']

        ]);
    }
}
