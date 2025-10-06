<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouveau Dossier') }}
            </h2>
            <a href="{{ route('dossiers.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('dossiers.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Titre -->
                            <div class="md:col-span-2">
                                <x-input-label for="titre" :value="__('Titre du dossier')" />
                                <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" :value="old('titre')" required autofocus />
                                <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                            </div>

                            <!-- Client -->
                            <div>
                                <x-input-label for="client_id" :value="__('Client')" />
                                <select id="client_id" name="client_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->prenom }} {{ $client->nom }} 
                                            @if($client->type === 'entreprise')
                                                ({{ $client->raison_sociale }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                            </div>

                            <!-- Type de procédure -->
                            <div>
                                <x-input-label for="type_procedure" :value="__('Type de procédure')" />
                                <select id="type_procedure" name="type_procedure" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="civile" {{ old('type_procedure') == 'civile' ? 'selected' : '' }}>Civile</option>
                                    <option value="penale" {{ old('type_procedure') == 'penale' ? 'selected' : '' }}>Pénale</option>
                                    <option value="commerciale" {{ old('type_procedure') == 'commerciale' ? 'selected' : '' }}>Commerciale</option>
                                    <option value="administrative" {{ old('type_procedure') == 'administrative' ? 'selected' : '' }}>Administrative</option>
                                    <option value="familiale" {{ old('type_procedure') == 'familiale' ? 'selected' : '' }}>Familiale</option>
                                </select>
                                <x-input-error :messages="$errors->get('type_procedure')" class="mt-2" />
                            </div>

                            <!-- Responsable -->
                            <div>
                                <x-input-label for="responsable_id" :value="__('Juriste responsable')" />
                                <select id="responsable_id" name="responsable_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un juriste</option>
                                    @foreach($juristes as $juriste)
                                        <option value="{{ $juriste->id }}" {{ old('responsable_id') == $juriste->id ? 'selected' : '' }}>
                                            {{ $juriste->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('responsable_id')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Créer le dossier') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>