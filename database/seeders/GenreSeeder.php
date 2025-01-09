<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['horror', 'comedy', 'romance', 'action', 'crime'];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'admin_id' => random_int(1, 5)
            ]);
        }
    }
}
