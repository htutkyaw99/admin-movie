<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Genre;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            GenreSeeder::class,
            TypeSeeder::class,
            DirectorSeeder::class,
            ProductionSeeder::class,
            ActorSeeder::class,
            MovieSeeder::class,
        ]);
    }
}
