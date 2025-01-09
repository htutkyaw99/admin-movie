<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'htutkyaw',
            'email' => 'htutkyaw@gmail.com',
            'password' => Hash::make('password'),
            'image' => fake()->text(200),
            'role_id' => 2
        ]);

        Admin::factory(4)->create();
    }
}
