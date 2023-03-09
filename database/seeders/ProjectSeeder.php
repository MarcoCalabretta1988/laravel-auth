<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 6; $i++) {
            $project = new Project();
            $project->name = $faker->words(3, true);
            $project->description = $faker->paragraphs(6, true);
            $project->github = "https://github.com/MarcoCalabretta1988";
            $project->linkedin = "www.linkedin.com/in/marco-calabretta-2b1b13195";
            $project->save();
        }
    }
}
