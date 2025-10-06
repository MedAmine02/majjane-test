<?php

namespace App\Policies;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DossierPolicy
{
   
    //   déterminer qui peut voir tous les dossiers
     
    public function viewAny(User $user): bool
    {
        // admin et juriste peuvent voir tous les dossiers
        return $user->isAdmin() || $user->isJuriste();
    }

    
    //   déterminer qui peut voir un dossier spécifique
     
    public function view(User $user, Dossier $dossier): bool
    {
        // admin peut tout voir
        if ($user->isAdmin()) {
            return true;
        }

        // juriste peut voir seulement ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // assistant peut voir seulement les dossiers (lecture seule)
        if ($user->isAssistant()) {
            return true; 
        }

        return false;
    }

    
    //   déterminer qui peut créer des dossiers
     
    public function create(User $user): bool
    {
        // Seuls admin et juriste peuvent créer des dossiers
        return $user->isAdmin() || $user->isJuriste();
    }

    
    //   déterminer qui peut modifier un dossier
     
    public function update(User $user, Dossier $dossier): bool
    {
        // admin peut tout modifier
        if ($user->isAdmin()) {
            return true;
        }

        // juriste peut modifier seulement ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // assistant ne peut pas modifier
        return false;
    }

    
    //   déterminer qui peut supprimer un dossier
     
    public function delete(User $user, Dossier $dossier): bool
    {
        // seul l'admin peut supprimer des dossiers
        return $user->isAdmin();
    }

    
    //   déterminer qui peut changer le statut d'un dossier
     
    public function changeStatus(User $user, Dossier $dossier): bool
    {
        // admin peut changer tous les statuts
        if ($user->isAdmin()) {
            return true;
        }

        // juriste peut changer le statut de ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // assistant ne peut pas changer les statuts
        return false;
    }

    
    //   déterminer qui peut uploader des documents
     
    public function uploadDocuments(User $user, Dossier $dossier): bool
    {
        // admin peut uploader sur tous les dossiers
        if ($user->isAdmin()) {
            return true;
        }

        // juriste peut uploader sur ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // assistant peut uploader (lecture/écriture limitée)
        if ($user->isAssistant()) {
            return true;
        }

        return false;
    }
}
