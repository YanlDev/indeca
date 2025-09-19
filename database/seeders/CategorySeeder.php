<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Desarrollo de Sistemas',
            'Desarrollo de Software',
            'Diseño Movil',
            'Seguridad y Salud Ocupacional',
            'Desarrollo de Videojuegos'
        ];

        foreach ($categories as $category) {
            category::create([
                'name' => $category,
            ]);
        }
    }
}
