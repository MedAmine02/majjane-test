<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Dossier;
use App\Policies\DossierPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Dossier::class => DossierPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Définir des Gates supplémentaires pour les rôles
        Gate::define('access-reports', function ($user) {
            return $user->isAdmin() || $user->isJuriste();
        });

        Gate::define('manage-clients', function ($user) {
            return $user->isAdmin() || $user->isJuriste();
        });

        Gate::define('view-all-dossiers', function ($user) {
            return $user->isAdmin();
        });
    }
}