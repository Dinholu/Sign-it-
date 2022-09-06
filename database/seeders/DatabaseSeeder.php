<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'HETT',
            'firstname' => 'Alizée',
            'email' => 'alizee@test.fr',
            'phone' => '0606060606',
            'ip' => 'jesuisbleu',
            'is_admin' => true,
            'password' => bcrypt('password'),
        ]);
    }
}
