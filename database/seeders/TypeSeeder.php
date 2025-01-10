<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Series', 'Movies', 'TV-Shows'];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type,
            ]);
        };
    }
}
