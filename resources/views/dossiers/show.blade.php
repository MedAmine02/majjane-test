<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dossier : {{ $dossier->reference }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ $dossier->titre }}
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('dossiers.edit', $dossier) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                    Modifier
                </a>
                <a href="{{ route('dossiers.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- informations du dossier -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- carte informations générales -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Informations du Dossier
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Référence</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-mono">
                                        {{ $dossier->reference }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Statut</label>
                                    <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($dossier->statut === 'en_cours') bg-yellow-100 text-yellow-800
                                        @elseif($dossier->statut === 'cloture') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Type de procédure</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ ucfirst($dossier->type_procedure) }}
                                    </p>
                                </div>
                                {{-- <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Date d'ouverture</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $dossier->date_ouverture->format('d/m/Y') }}
                                    </p>
                                </div> --}}
                                @if($dossier->date_cloture)
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de clôture</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $dossier->date_cloture->format('d/m/Y') }}
                                    </p>
                                </div>
                                @endif
                            </div>
                            
                            @if($dossier->description)
                            <div class="mt-4">
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white whitespace-pre-line">
                                    {{ $dossier->description }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- carte client -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Informations du Client
                            </h3>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 dark:text-blue-300 font-semibold text-lg">
                                        {{ substr($dossier->client->prenom, 0, 1) }}{{ substr($dossier->client->nom, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                        {{ $dossier->client->prenom }} {{ $dossier->client->nom }}
                                    </h4>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                        @if($dossier->client->email)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $dossier->client->email }}
                                        </div>
                                        @endif
                                        @if($dossier->client->telephone)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            {{ $dossier->client->telephone }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="space-y-6">
                    <!-- carte responsable -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Juriste Responsable
                            </h3>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600 dark:text-purple-300 font-semibold text-sm">
                                        {{ substr($dossier->responsable->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $dossier->responsable->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $dossier->responsable->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- carte documents -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Documents
                                </h3>
                                @can('uploadDocuments', $dossier)
                                <button onclick="document.getElementById('document-upload').classList.toggle('hidden')"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium transition duration-200">
                                    + Ajouter
                                </button>
                                @endcan
                            </div>

                            <!-- formulaire d'upload (caché par défaut) -->
                            @can('uploadDocuments', $dossier)
                            <div id="document-upload" class="hidden mb-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <form method="POST" action="{{ route('documents.store', $dossier) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="document" required 
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <button type="submit" class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded text-sm font-medium transition duration-200">
                                        Uploader
                                    </button>
                                </form>
                            </div>
                            @endcan

                            <!-- Liste des documents -->
                            <div class="space-y-2">
                                @forelse($dossier->documents as $document)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $document->nom }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ number_format($document->taille / 1024, 0) }} KB
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('documents.download', $document) }}" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                        @can('uploadDocuments', $dossier)
                                        <form method="POST" action="{{ route('documents.destroy', $document) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                    Aucun document pour ce dossier
                                </p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>