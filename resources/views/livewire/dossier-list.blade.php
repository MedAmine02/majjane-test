<div>
    <!-- barre de recherche et filtres -->
    <div class="mb-6 space-y-4 md:space-y-0 md:flex md:space-x-4">
        <!-- recherche -->
        <div class="flex-1 mb-6">
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Rechercher par titre, référence ou client..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <!-- filtre statut -->
        <select wire:model.live="statutFilter" class="w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-700">
            <option value="">Tous les statuts</option>
            <option value="en_cours">En Cours</option>
            <option value="cloture">Clôturé</option>
            <option value="suspendu">Suspendu</option>
        </select>

        <!-- filtre juriste -->
        @auth
            @if(auth()->user()->isAdmin())
                <select wire:model.live="juristeFilter" class="w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-700">
                    <option value="">Tous les juristes</option>
                    @foreach($juristes as $juriste)
                        <option value="{{ $juriste->id }}">{{ $juriste->name }}</option>
                    @endforeach
                </select>
            @endif
        @endauth
    </div>

    <!-- tableau des dossiers -->
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Référence
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Titre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Responsable
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($dossiers as $dossier)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $dossier->reference }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $dossier->titre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $dossier->client->prenom }} {{ $dossier->client->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ ucfirst($dossier->type_procedure) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select 
                                    wire:change="updateStatus({{ $dossier->id }}, $event.target.value)"
                                    class="text-sm border-0 rounded focus:ring-2 focus:ring-blue-500 text-gray-700 bg-opacity-20
                                        @if($dossier->statut === 'en_cours') bg-yellow-100 text-yellow-800
                                        @elseif($dossier->statut === 'cloture') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif"
                                >
                                    <option value="en_cours" @selected($dossier->statut === 'en_cours')>En Cours</option>
                                    <option value="cloture" @selected($dossier->statut === 'cloture')>Clôturé</option>
                                    <option value="suspendu" @selected($dossier->statut === 'suspendu')>Suspendu</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $dossier->responsable->name ?? 'Non assigné'}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('dossiers.show', $dossier) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                    Voir
                                </a>
                                <a href="{{ route('dossiers.edit', $dossier) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    Éditer
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                Aucun dossier trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $dossiers->links() }}
        </div>
    </div>
</div>