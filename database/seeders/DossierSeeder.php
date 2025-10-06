<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Dossier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $juristes = User::where('role', 'juriste')->get();
        $clients = Client::all();

        $dossiers = [
            [
                'titre' => 'Litige contractuel - Fournisseur',
                'description' => 'Litige concernant la non-conformité des produits livrés par le fournisseur principal.',
                'type_procedure' => 'commerciale',
                'statut' => 'en_cours',
                'date_ouverture' => Carbon::now()->subMonths(2),
                'client_id' => $clients->where('type', 'entreprise')->first()->id,
                'user_id' => $juristes->first()->id,
            ],
            [
                'titre' => 'Divorce - Consentement mutuel',
                'description' => 'Procedure de divorce par consentement mutuel avec accord sur la garde des enfants.',
                'type_procedure' => 'familiale',
                'statut' => 'en_cours',
                'date_ouverture' => Carbon::now()->subMonth(1),
                'client_id' => $clients->where('type', 'particulier')->first()->id,
                'user_id' => $juristes->last()->id,
            ],
            [
                'titre' => 'Défense pénale - Affaire diffamation',
                'description' => 'Assistance juridique dans une affaire de diffamation publique.',
                'type_procedure' => 'penale',
                'statut' => 'suspendu',
                'date_ouverture' => Carbon::now()->subMonths(3),
                'client_id' => $clients->where('type', 'particulier')->skip(1)->first()->id,
                'user_id' => $juristes->first()->id,
            ],
            [
                'titre' => 'Contentieux administratif - Permis de construire',
                'description' => 'Recours contre le refus de permis de construire pour extension de locaux commerciaux.',
                'type_procedure' => 'administrative',
                'statut' => 'cloture',
                'date_ouverture' => Carbon::now()->subMonths(6),
                'date_cloture' => Carbon::now()->subMonth(1),
                'client_id' => $clients->where('type', 'entreprise')->last()->id,
                'user_id' => $juristes->last()->id,
            ],
            [
                'titre' => 'Succession - Règlement de patrimoine',
                'description' => 'Gestion de la succession et répartition du patrimoine familial.',
                'type_procedure' => 'familiale',
                'statut' => 'en_cours',
                'date_ouverture' => Carbon::now()->subWeeks(2),
                'client_id' => $clients->where('type', 'particulier')->last()->id,
                'user_id' => $juristes->first()->id,
            ],
        ];

        foreach ($dossiers as $dossier) {
            Dossier::create($dossier);
        }

        echo "Dossiers créés avec succès!\n";
    }
}
