<?php

namespace Database\Seeders;

use App\Models\MedicalVisit;
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

        $halsey = Pet::create([
            'user_id' => $user->id,
            'name' => 'Halsey',
            'species' => 'canino',
            'birth_date' => '2024-12-13',
            'gender' => 'female',
            'weight' => 3,
            'color' => 'cafe',
            'photo' => '🐶'
        ]);

        $menta = Pet::create([
            'user_id' => $user->id,
            'name' => 'Menta',
            'species' => 'felino',
            'birth_date' => '2026-12-13',
            'gender' => 'female',
            'weight' => 10,
            'color' => 'negro',
            'photo' => '🐱'
        ]);

        MedicalVisit::create([
            'pet_id' => $halsey->id,
            'visit_date' => '2026-05-13',
            'reason' => 'vacunación',
            'diagnosis' => 'Cobertura de la vacuna antirrábica próxima a vencer',
            'treatment' => 'Nuevo ciclo de vacuna antirrábica',
            'notes' => 'Se deja vacunar sin complicaciones.',
        ]);

        MedicalVisit::create([
            'pet_id' => $halsey->id,
            'visit_date' => '2026-05-14',
            'reason' => 'Vómitos',
            'diagnosis' => 'Intolerancia a las nueces',
            'treatment' => 'Cambio de alimento. Dar arroz con pollito cocido sin condimentos',
            'notes' => 'Evaluar en una semana si no mejora visitar urgencia',
        ]);
    }
}
