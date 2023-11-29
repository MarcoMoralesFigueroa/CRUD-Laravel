<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumno;
use Faker\Factory as Faker;


class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla antes de insertar nuevos datos
        Alumno::truncate();

        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            Alumno::create([
                'matricula' => $faker->unique()->numerify('#########'),
                'nombre' => $faker->name,
                'fecha_nacimiento' => $faker->dateTimeBetween,
                'telefono' => $faker->phoneNumber,
                'email' => $faker->email,
                'nivel_id' => $faker->numberBetween(1, 8), // Ajusta según tus niveles existentes
                'is_deleted'=> false,
            ]);
        }
    }
}
