<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competition::insert([
            'competition_name' => 'InnovateX',
            'num_of_events' => 5,
            'description' => "InnovateX is a dynamic competition that invites participants to unleash their creativity and problem-solving skills. It's your chance to showcase innovative ideas and solutions across different fields.",
            'start_date' => null,
            'expire_date' => null,
        ]);
    }
}
