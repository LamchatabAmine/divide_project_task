<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'name' => 'Portfolio',
            'description' => 'Développement d\'un site web mettant en valeur nos compétences',
            'startDate' => now(),
            'endDate' => now(),
        ]);
        Project::create([
            'name' => 'Arbre des compétences',
            'description' => 'Création d\'une application web pour l\'évaluation des compétences.',
            'startDate' => now(),
            'endDate' => now(),
        ]);
        Project::create([
            'name' => 'CNMH',
            'description' => 'Création d\'une application web pour la gestion des patients de centre CNMH.',
            'startDate' => now(),
            'endDate' => now(),
        ]);
    }
}
