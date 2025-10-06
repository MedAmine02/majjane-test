<?php

namespace App\Policies;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DossierPolicy
{
   /**
     * Déterminer qui peut voir tous les dossiers
     */
    public function viewAny(User $user): bool
    {
        // Admin et Juriste peuvent voir tous les dossiers
        return $user->isAdmin() || $user->isJuriste();
    }

    /**
     * Déterminer qui peut voir un dossier spécifique
     */
    public function view(User $user, Dossier $dossier): bool
    {
        // Admin peut tout voir
        if ($user->isAdmin()) {
            return true;
        }

        // Juriste peut voir seulement ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // Assistant peut voir seulement les dossiers (lecture seule)
        if ($user->isAssistant()) {
            return true; // ou des restrictions plus spécifiques si besoin
        }

        return false;
    }

    /**
     * Déterminer qui peut créer des dossiers
     */
    public function create(User $user): bool
    {
        // Seuls Admin et Juriste peuvent créer des dossiers
        return $user->isAdmin() || $user->isJuriste();
    }

    /**
     * Déterminer qui peut modifier un dossier
     */
    public function update(User $user, Dossier $dossier): bool
    {
        // Admin peut tout modifier
        if ($user->isAdmin()) {
            return true;
        }

        // Juriste peut modifier seulement ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // Assistant ne peut pas modifier
        return false;
    }

    /**
     * Déterminer qui peut supprimer un dossier
     */
    public function delete(User $user, Dossier $dossier): bool
    {
        // Seul l'admin peut supprimer des dossiers
        return $user->isAdmin();
    }

    /**
     * Déterminer qui peut changer le statut d'un dossier
     */
    public function changeStatus(User $user, Dossier $dossier): bool
    {
        // Admin peut changer tous les statuts
        if ($user->isAdmin()) {
            return true;
        }

        // Juriste peut changer le statut de ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // Assistant ne peut pas changer les statuts
        return false;
    }

    /**
     * Déterminer qui peut uploader des documents
     */
    public function uploadDocuments(User $user, Dossier $dossier): bool
    {
        // Admin peut uploader sur tous les dossiers
        if ($user->isAdmin()) {
            return true;
        }

        // Juriste peut uploader sur ses dossiers assignés
        if ($user->isJuriste()) {
            return $dossier->responsable_id === $user->id;
        }

        // Assistant peut uploader (lecture/écriture limitée)
        if ($user->isAssistant()) {
            return true;
        }

        return false;
    }
}
