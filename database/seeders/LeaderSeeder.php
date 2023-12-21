<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'leader',
            'lastName' => 'leader',
            'email' => 'leader@solicode.co',
            'password' => bcrypt('leader'),
        ])->assignRole('leader');
    }
}
