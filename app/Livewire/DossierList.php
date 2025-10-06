<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Dossier;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class DossierList extends Component
{
   use WithPagination;

    public $search = '';
    public $statutFilter = '';
    public $juristeFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus($dossierId, $newStatut)
    {
        $dossier = Dossier::findOrFail($dossierId);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Vérifier les autorisations
        if ($user->isAdmin() || 
            ($user->isJuriste() && $dossier->user_id == $user->id())) {
            $dossier->update(['statut' => $newStatut]);
            
            
            $this->dispatch('statusUpdated');
        }
    }

    public function render()
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = Dossier::with(['client', 'responsable'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('titre', 'like', '%' . $this->search . '%')
                      ->orWhere('reference', 'like', '%' . $this->search . '%')
                      ->orWhereHas('client', function ($q) {
                          $q->where('nom', 'like', '%' . $this->search . '%')
                            ->orWhere('prenom', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statutFilter, function ($query) {
                $query->where('statut', $this->statutFilter);
            })
            ->when($this->juristeFilter, function ($query) {
                $query->where('user_id', $this->juristeFilter);
            })
            ->when($user->isJuriste(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc');

        $dossiers = $query->paginate(10);
        $juristes = User::where('role', 'juriste')->get();

        return view('livewire.dossier-list', compact('dossiers', 'juristes'));
    }
}
