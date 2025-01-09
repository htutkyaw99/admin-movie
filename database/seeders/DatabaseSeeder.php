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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Admin::factory(5)->create();

        $roles = ['admin', 'super_admin'];

        foreach ($roles as $role) {
            Role::factory()->create([
                'name' => $role
            ]);
        }

        $genres = ['horror', 'comedy', 'romance', 'action'];

        foreach ($genres as $genre) {
            Genre::factory()->create([
                'name' => $genre,
                'admin_id' => User::factory()
            ]);
        }
    }
}
