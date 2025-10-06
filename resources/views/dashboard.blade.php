


<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tableau de Bord') }}
            </h2>
            <div class="flex space-x-4">
                @can('create', App\Models\Dossier::class)
                    <a href="{{ route('dossiers.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                        + Nouveau Dossier
                    </a>
                @endcan
                @can('manage-clients')
                    <a href="{{ route('clients.create') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                        + Nouveau Client
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- statistiques -->
            <livewire:dashboard-stats />
            
            <!-- liste des dossiers avec recherche et filtres -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Dossiers Récents</h3>
                        <a href="{{ route('dossiers.index') }}" 
                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                            Voir tous les dossiers →
                        </a>
                    </div>
                    <livewire:dossier-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>