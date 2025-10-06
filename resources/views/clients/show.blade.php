<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Client : {{ $client->prenom }} {{ $client->nom }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ $client->type === 'entreprise' ? $client->raison_sociale : 'Particulier' }}
                </p>
            </div>
            <div class="flex space-x-2">
                @can('manage-clients')
                <a href="{{ route('clients.edit', $client) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                    Modifier
                </a>
                @endcan
                <a href="{{ route('clients.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informations du client -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Informations Personnelles
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $client->nom }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Prénom</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $client->prenom }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white capitalize">{{ $client->type }}</p>
                                </div>
                                @if($client->type === 'entreprise')
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Raison Sociale</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $client->raison_sociale }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">SIRET</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-mono">{{ $client->siret }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Contact
                            </h3>
                            <div class="space-y-3">
                                @if($client->email)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-sm text-gray-900 dark:text-white">{{ $client->email }}</span>
                                </div>
                                @endif
                                @if($client->telephone)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="text-sm text-gray-900 dark:text-white">{{ $client->telephone }}</span>
                                </div>
                                @endif
                                @if($client->adresse)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-900 dark:text-white">{{ $client->adresse }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Dossiers du client -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Dossiers ({{ $client->dossiers->count() }})
                            </h3>
                            <div class="space-y-3">
                                @forelse($client->dossiers as $dossier)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $dossier->reference }} - {{ Str::limit($dossier->titre, 30) }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($dossier->type_procedure) }} • 
                                            <span class="capitalize">{{ str_replace('_', ' ', $dossier->statut) }}</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('dossiers.show', $dossier) }}" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                        Voir
                                    </a>
                                </div>
                                @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                    Aucun dossier pour ce client
                                </p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    @can('manage-clients')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Actions
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ route('dossiers.create') }}?client_id={{ $client->id }}" 
                                   class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded text-sm font-medium transition duration-200">
                                    Nouveau Dossier
                                </a>
                                <form method="POST" action="{{ route('clients.destroy', $client) }}" class="inline w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.')"
                                            class="block w-full bg-red-600 hover:bg-red-700 text-white text-center py-2 px-4 rounded text-sm font-medium transition duration-200">
                                        Supprimer le client
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>