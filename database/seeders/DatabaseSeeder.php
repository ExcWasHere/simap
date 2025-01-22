<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            User::factory()->create([
                'name' => 'Administrator',
                'NIP' => '1234567890',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);

            if (app()->environment('local', 'development')) {
                User::factory(5)->create();
            }
            
        } catch (\Exception $e) {
            \Log::error('Error seeding database:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

