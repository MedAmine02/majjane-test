<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ClientSeeder::class,
            UserSeeder::class,
            DossierSeeder::class,
        ]);

        echo "\n✅ Base de données peuplée avec succès!\n";
        echo "📧 Comptes de test créés:\n";
        echo "   Admin: admin@cabinet.com / password\n";
        echo "   Juriste: marie.dubois@cabinet.com / password\n";
        echo "   Assistant: sophie@cabinet.com / password\n";
    }
}
