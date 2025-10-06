<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Modifier le Dossier') }} : {{ $dossier->reference }}
            </h2>
            <a href="{{ route('dossiers.show', $dossier) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                ← Annuler
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('dossiers.update', $dossier) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- titre -->
                            <div class="md:col-span-2">
                                <x-input-label for="titre" :value="__('Titre du dossier')" />
                                <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" :value="old('titre', $dossier->titre)" required autofocus />
                                <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                            </div>

                            <!-- client -->
                            <div>
                                <x-input-label for="client_id" :value="__('Client')" />
                                <select id="client_id" name="client_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $dossier->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->prenom }} {{ $client->nom }} 
                                            @if($client->type === 'entreprise')
                                                ({{ $client->raison_sociale }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                            </div>

                            <!-- type de procédure -->
                            <div>
                                <x-input-label for="type_procedure" :value="__('Type de procédure')" />
                                <select id="type_procedure" name="type_procedure" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="civile" {{ old('type_procedure', $dossier->type_procedure) == 'civile' ? 'selected' : '' }}>Civile</option>
                                    <option value="penale" {{ old('type_procedure', $dossier->type_procedure) == 'penale' ? 'selected' : '' }}>Pénale</option>
                                    <option value="commerciale" {{ old('type_procedure', $dossier->type_procedure) == 'commerciale' ? 'selected' : '' }}>Commerciale</option>
                                    <option value="administrative" {{ old('type_procedure', $dossier->type_procedure) == 'administrative' ? 'selected' : '' }}>Administrative</option>
                                    <option value="familiale" {{ old('type_procedure', $dossier->type_procedure) == 'familiale' ? 'selected' : '' }}>Familiale</option>
                                </select>
                                <x-input-error :messages="$errors->get('type_procedure')" class="mt-2" />
                            </div>

                            <!-- statut -->
                            <div>
                                <x-input-label for="statut" :value="__('Statut')" />
                                <select id="statut" name="statut" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="en_cours" {{ old('statut', $dossier->statut) == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                                    <option value="cloture" {{ old('statut', $dossier->statut) == 'cloture' ? 'selected' : '' }}>Clôturé</option>
                                    <option value="suspendu" {{ old('statut', $dossier->statut) == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                                </select>
                                <x-input-error :messages="$errors->get('statut')" class="mt-2" />
                            </div>

                            <!-- responsable -->
                            <div>
                                <x-input-label for="user_id" :value="__('Juriste responsable')" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un juriste</option>
                                    @foreach($juristes as $juriste)
                                        <option value="{{ $juriste->id }}" {{ old('user_id', $dossier->user_id) == $juriste->id ? 'selected' : '' }}>
                                            {{ $juriste->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                             <!-- date d'ouverture -->
                             <div>
                                <x-input-label for="date_ouverture" :value="__('Date d\'ouverture')" />
                                <x-text-input id="date_ouverture" class="block mt-1 w-full" type="date" name="date_ouverture" :value="old('date_ouverture', $dossier->date_ouverture->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('date_ouverture')" class="mt-2" />
                            </div>

                            <!-- date de clôture -->
                            <div>
                                <x-input-label for="date_cloture" :value="__('Date de clôture (si applicable)')" />
                                <x-text-input id="date_cloture" class="block mt-1 w-full" type="date" name="date_cloture" :value="old('date_cloture', $dossier->date_cloture ? $dossier->date_cloture->format('Y-m-d') : '')" />
                                <x-input-error :messages="$errors->get('date_cloture')" class="mt-2" />
                            </div> 

                            <!-- description -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $dossier->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Mettre à jour le dossier') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>