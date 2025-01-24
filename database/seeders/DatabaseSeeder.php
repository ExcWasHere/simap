<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'NIP' => '1234567890',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'John Doe',
            'NIP' => '2234567890',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Jane Doe',
            'NIP' => '3234567890',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(5)->create();
    }
}