<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Dossier;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class DashboardStats extends Component
{
    public function render()
    {
        Gate::authorize('access-reports');

        $stats = [
            'total_dossiers' => Dossier::count(),
            'dossiers_en_cours' => Dossier::where('statut', 'en_cours')->count(),
            'dossiers_clotures' => Dossier::where('statut', 'cloture')->count(),
            'dossiers_suspendus' => Dossier::where('statut', 'suspendu')->count(),
            'clients_actifs' => Client::has('dossiers')->count(),
            'total_clients' => Client::count(),
        ];

        return view('livewire.dashboard-stats', compact('stats'));
    }
}
