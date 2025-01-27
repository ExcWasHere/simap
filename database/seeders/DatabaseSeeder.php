<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'nip' => '1234567890',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Excell Christian',
            'nip' => '1133557799',
            'email' => 'excellchriatian12@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pramudya Surya',
            'nip' => '0987654321',
            'email' => 'prasuatra@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Rafi Abiyyu Airlangga',
            'nip' => '1335557777',
            'email' => 'mizukinako7@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}