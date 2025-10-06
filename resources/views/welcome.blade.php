<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cabinet Juridique - Gestion des Dossiers</title>
        
        <!-- Chargement de Tailwind CSS depuis CDN en attendant que Vite fonctionne -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
        
        <!-- Essayer aussi de charger via Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="max-w-6xl w-full">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="md:flex">
                        <!-- Partie gauche -->
                        <div class="md:flex-1 p-8 md:p-12">
                            <div class="flex items-center mb-8">
                                <div class="bg-blue-600 text-white p-3 rounded-lg mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">Cabinet Juridique</h1>
                                    <p class="text-blue-600 font-medium">Système de gestion</p>
                                </div>
                            </div>
                            
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                                Gestion des Dossiers Juridiques
                            </h2>
                            
                            <p class="text-gray-600 mb-8 leading-relaxed">
                                Application sécurisée pour la gestion des clients, dossiers juridiques et documents. 
                                Accédez à votre espace professionnel pour suivre l'évolution des procédures et collaborer avec votre équipe.
                            </p>

                            <div class="space-y-4 mb-8">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Gestion centralisée des dossiers clients</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Suivi en temps réel des procédures</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Stockage sécurisé des documents</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700">Interface moderne et intuitive</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('login') }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200 text-center shadow-sm">
                                    Se connecter
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                       class="border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-3 px-8 rounded-lg transition duration-200 text-center">
                                        Créer un compte
                                    </a>
                                @endif
                            </div>

                            <!-- Informations de test -->
                            <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <h4 class="text-sm font-semibold text-blue-800 mb-2">Comptes de démonstration :</h4>
                                <div class="text-xs text-blue-700 space-y-1">
                                    <div><span class="font-medium">Admin:</span> admin@cabinet.com / password</div>
                                    <div><span class="font-medium">Juriste:</span> marie.dubois@cabinet.com / password</div>
                                    <div><span class="font-medium">Assistant:</span> sophie@cabinet.com / password</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Partie droite -->
                        <div class="md:flex-1 bg-gradient-to-br from-blue-600 to-blue-800 p-8 md:p-12 text-white">
                            <h3 class="text-xl font-semibold mb-8">Accès par Rôle</h3>
                            <div class="space-y-6">
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 rounded-xl border border-white border-opacity-20">
                                    <div class="flex items-start">
                                        <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-4">
                                            <span class="text-lg">👨‍💼</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg mb-2">Administrateur</h4>
                                            <p class="text-blue-100 text-sm opacity-90">Accès complet à tous les modules, gestion des utilisateurs et rapports</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 rounded-xl border border-white border-opacity-20">
                                    <div class="flex items-start">
                                        <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-4">
                                            <span class="text-lg">⚖️</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg mb-2">Juriste</h4>
                                            <p class="text-blue-100 text-sm opacity-90">Gestion des dossiers assignés, suivi des procédures et consultation des documents</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 rounded-xl border border-white border-opacity-20">
                                    <div class="flex items-start">
                                        <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-4">
                                            <span class="text-lg">👨‍💻</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg mb-2">Assistant</h4>
                                            <p class="text-blue-100 text-sm opacity-90">Consultation des dossiers, gestion documentaire et suivi des échéances</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Statistiques -->
                            <div class="mt-8 pt-6 border-t border-white border-opacity-20">
                                <h4 class="font-semibold mb-4">Notre Plateforme</h4>
                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <div class="text-2xl font-bold">50+</div>
                                        <div class="text-blue-100 text-xs opacity-80">Dossiers actifs</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold">30+</div>
                                        <div class="text-blue-100 text-xs opacity-80">Clients satisfaits</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-gray-500 text-sm">
                        &copy; {{ date('Y') }} Cabinet Juridique. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>