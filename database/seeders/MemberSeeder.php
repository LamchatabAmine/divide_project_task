<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'firstName' => 'member',
            'lastName' => 'member',
            'email' => 'member@solicode.co',
            'password' => bcrypt('member'),
        ])->assignRole('member');
    }
}
