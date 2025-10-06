<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('access-reports');

        $stats = [
            'total_dossiers' => Dossier::count(),
            'dossiers_par_statut' => Dossier::groupBy('statut')
                ->selectRaw('statut, count(*) as total')
                ->get(),
            'clients_actifs' => Client::has('dossiers')->count(),
            'total_clients' => Client::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
