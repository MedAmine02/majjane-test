<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'numero_client' => 'CLI001',
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@email.com',
                'telephone' => '01 23 45 67 89',
                'adresse' => '123 Avenue des Champs, Paris',
                'ville' => 'Paris',
                'code_postal' => '75008',
                'type' => 'particulier',
            ],
            [
                'numero_client' => 'CLI002',
                'nom' => 'Bernard',
                'prenom' => 'Marie',
                'email' => 'marie.bernard@email.com',
                'telephone' => '01 34 56 78 90',
                'adresse' => '456 Rue de la Paix, Lyon',
                'ville' => 'Lyon',
                'code_postal' => '69001',
                'type' => 'particulier',
            ],
            [
                'numero_client' => 'CLI003',
                'nom' => 'Technologie SARL',
                'prenom' => '', // vide pour entreprise
                'email' => 'contact@technologie-sarl.com',
                'telephone' => '01 45 67 89 01',
                'adresse' => '789 Boulevard des Entreprises, Lille',
                'ville' => 'Lille',
                'code_postal' => '59000',
                'type' => 'entreprise',
                'raison_sociale' => 'Technologie SARL',
                'siret' => '12345678901234',
            ],
            [
                'numero_client' => 'CLI004',
                'nom' => 'Moreau',
                'prenom' => 'Luc',
                'email' => 'luc.moreau@email.com',
                'telephone' => '02 34 56 78 91',
                'adresse' => '321 Rue du Commerce, Bordeaux',
                'ville' => 'Bordeaux',
                'code_postal' => '33000',
                'type' => 'particulier',
            ],
            [
                'numero_client' => 'CLI005',
                'nom' => 'Construction SA',
                'prenom' => '',
                'email' => 'info@construction-sa.com',
                'telephone' => '03 45 67 89 12',
                'adresse' => '654 Avenue Industrielle, Marseille',
                'ville' => 'Marseille',
                'code_postal' => '13001',
                'type' => 'entreprise',
                'raison_sociale' => 'Construction SA',
                'siret' => '98765432109876',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }

        echo "Clients créés avec succès!\n";
    }
}
