<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DossierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
    
        $dossiers = Dossier::with(['client', 'responsable'])
        ->when($user->isJuriste(), function ($query) use ($user) {
            return $query->where('responsable_id', $user->id);
        })
        ->latest()
        ->get();

        return view('dossiers.index', compact('dossiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $juristes = User::where('role', 'juriste')->get();
        
        return view('dossiers.create', compact('clients', 'juristes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type_procedure' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'date_ouverture' => 'required|date', 
        ]);

        // Dossier::create($request->all());

        Dossier::create([
            'titre' => $request->titre,
            'type_procedure' => $request->type_procedure,
            'client_id' => $request->client_id,
            'user_id' => $request->user_id, // CHANGER responsable_id → user_id
            'description' => $request->description,
            'date_ouverture' => $request->date_ouverture ?? now(), // Date d'aujourd'hui par défaut
            'statut' => 'en_cours', // Statut par défaut
        ]);
        return redirect()->route('dossiers.index')->with('success', 'Dossier créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dossier $dossier)
    {
        $this->authorize('view', $dossier);
        
        return view('dossiers.show', compact('dossier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dossier $dossier)
    {
        $this->authorize('update', $dossier);
        
        $clients = Client::all();
        $juristes = User::where('role', 'juriste')->get();
        
        return view('dossiers.edit', compact('dossier', 'clients', 'juristes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dossier $dossier)
    {
        $this->authorize('update', $dossier);

        $request->validate([
            'titre' => 'required|string|max:255',
            'type_procedure' => 'required|string',
            'statut' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'date_ouverture' => 'required|date',
            'date_cloture' => 'nullable|date',
        ]);

        $dossier->update($request->all());

        return redirect()->route('dossiers.index')->with('success', 'Dossier mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dossier $dossier)
    {
        $this->authorize('delete', $dossier);
        
        $dossier->delete();

        return redirect()->route('dossiers.index')->with('success', 'Dossier supprimé avec succès.');
    }

    public function updateStatus(Request $request, Dossier $dossier)
    {
        $this->authorize('changeStatus', $dossier);

        $request->validate([
            'statut' => 'required|string|in:en cours,clôturé,suspendu'
        ]);

        $dossier->update(['statut' => $request->statut]);

        return response()->json(['success' => true, 'statut' => $dossier->statut]);
    }
}
