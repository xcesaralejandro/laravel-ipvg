<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Pet;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'César',
            'surname' => 'Mora',
            'email' => 'cesar.mora@virginiogomez.cl',
            'password' => bcrypt('asd123'),
            'gender' => 'male',
            'birth_date' => '1995-12-20',
        ]);

        Pet::create([
        'user_id' => $user->id,
        'name' => 'Halsey',
        'species' => 'canino',
        'birth_date' => '2024-12-13',
        'gender' => 'female',
        'weight' => 3,
        'color' => 'cafe',
        'photo' => 'halsey.jpg'
        ]);

        Pet::create([
        'user_id' => $user->id,
        'name' => 'Menta',
        'species' => 'felino',
        'birth_date' => '2026-12-13',
        'gender' => 'female',
        'weight' => 10,
        'color' => 'negro',
        'photo' => 'menta.jpg'
        ]);
    }
}
