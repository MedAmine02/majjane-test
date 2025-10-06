<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouveau Client') }}
            </h2>
            <a href="{{ route('clients.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('clients.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type de client -->
                            <div class="md:col-span-2">
                                <x-input-label for="type" :value="__('Type de client')" />
                                <select id="type" name="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="particulier" {{ old('type') == 'particulier' ? 'selected' : '' }}>Particulier</option>
                                    <option value="entreprise" {{ old('type') == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <!-- Nom -->
                            <div>
                                <x-input-label for="nom" :value="__('Nom')" />
                                <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                            </div>

                            <!-- Prénom -->
                            <div id="prenom-field">
                                <x-input-label for="prenom" :value="__('Prénom')" />
                                <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" />
                                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                            </div>

                            <!-- Raison Sociale (entreprise) -->
                            <div id="raison-sociale-field" class="hidden md:col-span-2">
                                <x-input-label for="raison_sociale" :value="__('Raison Sociale')" />
                                <x-text-input id="raison_sociale" class="block mt-1 w-full" type="text" name="raison_sociale" :value="old('raison_sociale')" />
                                <x-input-error :messages="$errors->get('raison_sociale')" class="mt-2" />
                            </div>

                            <!-- SIRET (entreprise) -->
                            <div id="siret-field" class="hidden">
                                <x-input-label for="siret" :value="__('SIRET')" />
                                <x-text-input id="siret" class="block mt-1 w-full" type="text" name="siret" :value="old('siret')" />
                                <x-input-error :messages="$errors->get('siret')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <x-input-label for="telephone" :value="__('Téléphone')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>

                            <!-- Adresse -->
                            <div class="md:col-span-2">
                                <x-input-label for="adresse" :value="__('Adresse')" />
                                <textarea id="adresse" name="adresse" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('adresse') }}</textarea>
                                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Créer le client') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('type').addEventListener('change', function() {
            const isEntreprise = this.value === 'entreprise';
            
            // Afficher/masquer les champs entreprise/particulier
            document.getElementById('prenom-field').classList.toggle('hidden', isEntreprise);
            document.getElementById('raison-sociale-field').classList.toggle('hidden', !isEntreprise);
            document.getElementById('siret-field').classList.toggle('hidden', !isEntreprise);
            
            // Rendre le prénom obligatoire pour les particuliers
            document.getElementById('prenom').required = !isEntreprise;
            document.getElementById('raison_sociale').required = isEntreprise;
        });

        // Déclencher l'événement au chargement pour l'état initial
        document.getElementById('type').dispatchEvent(new Event('change'));
    </script>
</x-app-layout>