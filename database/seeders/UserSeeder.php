<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        User::create([
            'name' => 'Admin Cabinet',
            'email' => 'admin@cabinet.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // juristes
        User::create([
            'name' => 'Marie Dubois',
            'email' => 'marie.dubois@cabinet.com',
            'password' => Hash::make('password'),
            'role' => 'juriste',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Pierre Martin',
            'email' => 'pierre.martin@cabinet.com',
            'password' => Hash::make('password'),
            'role' => 'juriste',
            'email_verified_at' => now(),
        ]);

        // assistant
        User::create([
            'name' => 'Sophie Assistant',
            'email' => 'sophie@cabinet.com',
            'password' => Hash::make('password'),
            'role' => 'assistant',
            'email_verified_at' => now(),
        ]);

        echo "Users créés avec succès!\n";
    }
}
