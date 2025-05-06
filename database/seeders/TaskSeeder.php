<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $tasks = [
        [
            'title' => 'Fix leaky faucet',
            'description' => 'The kitchen sink is leaking and needs repair.',
            'budget' => 1200,
            'due_date' => '2025-05-10',
            'due_time' => '14:00',
            'location' => 'Skopje, Centar',
            'estimated_time' => '2',
            'user_id' => 1,
            'category_id' => 3,
        ],
        [
            'title' => 'Assemble IKEA furniture',
            'description' => 'Need someone to assemble a wardrobe.',
            'budget' => 2000,
            'due_date' => '2025-05-08',
            'due_time' => '10:00',
            'location' => 'Bitola, City Center',
            'estimated_time' => '3',
            'user_id' => 2,
            'category_id' => 4,
        ],
        [
            'title' => 'Mow the lawn',
            'description' => 'Front and back yard need mowing.',
            'budget' => 1000,
            'due_date' => '2025-05-07',
            'due_time' => '09:00',
            'location' => 'Ohrid, Lakeside',
            'estimated_time' => '1',
            'user_id' => 1,
            'category_id' => 5,
        ],
        [
            'title' => 'Paint bedroom walls',
            'description' => 'White paint, materials provided.',
            'budget' => 3000,
            'due_date' => '2025-05-12',
            'due_time' => '11:00',
            'location' => 'Tetovo, Džepčishte',
            'estimated_time' => '5',
            'user_id' => 3,
            'category_id' => 6,
        ],
        [
            'title' => 'Deliver groceries',
            'description' => 'Pick up a list of items from the market.',
            'budget' => 700,
            'due_date' => '2025-05-06',
            'due_time' => '16:00',
            'location' => 'Skopje, Karpoš',
            'estimated_time' => '1',
            'user_id' => 2,
            'category_id' => 2,
        ],
        [
            'title' => 'Babysit for the evening',
            'description' => '3-year-old girl, 5 PM to 9 PM.',
            'budget' => 2500,
            'due_date' => '2025-05-09',
            'due_time' => '17:00',
            'location' => 'Prilep, Center',
            'estimated_time' => '4',
            'user_id' => 4,
            'category_id' => 7,
        ],
        [
            'title' => 'Repair bicycle brakes',
            'description' => 'Front brakes are loose and need adjustment.',
            'budget' => 800,
            'due_date' => '2025-05-07',
            'due_time' => '13:00',
            'location' => 'Veles, Downtown',
            'estimated_time' => '1.5',
            'user_id' => 1,
            'category_id' => 3,
        ],
        [
            'title' => 'Write blog post',
            'description' => 'Topic: benefits of remote work. 1000 words.',
            'budget' => 1500,
            'due_date' => '2025-05-11',
            'due_time' => '18:00',
            'location' => 'Remote',
            'estimated_time' => '2',
            'user_id' => 3,
            'category_id' => 1,
        ],
        [
            'title' => 'Dog walking service',
            'description' => 'Walk 2 dogs around the park for 1 hour.',
            'budget' => 1000,
            'due_date' => '2025-05-08',
            'due_time' => '08:00',
            'location' => 'Skopje, Taftalidže',
            'estimated_time' => '1',
            'user_id' => 2,
            'category_id' => 8,
        ],
        [
            'title' => 'Clean apartment',
            'description' => 'Full cleaning of a 2-bedroom apartment.',
            'budget' => 2800,
            'due_date' => '2025-05-10',
            'due_time' => '12:00',
            'location' => 'Kumanovo, Center',
            'estimated_time' => '3',
            'user_id' => 4,
            'category_id' => 9,
        ],
    ];

    foreach ($tasks as $taskData) {
        Task::create($taskData);
    }


        }
    }