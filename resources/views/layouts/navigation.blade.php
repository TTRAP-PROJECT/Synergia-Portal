<nav x-data="{ open: false }" class="bg-white dark:bg-white-800 border-b border-gray-100 dark:border-gray-700 h-24 py-2">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-black dark:text-black" />
                    </a>
                </div>

                <!-- Title -->
                <div class="ml-2 text-black dark:text-black font-semibold">
                    {{ __('Synergia Portal') }}
                </div>
            </div>

            <!-- User Logo and Search Bar (déplacé à droite avec une marge de 10px) -->
            <div class="flex flex-col items-end mr-5 absolute top-0 right-1 mb-5">
                <!-- User Logo -->
                <div class="mr-1 pt-0 flex flex-row-reverse">
                    <!-- Ajoutez votre logo d'utilisateur ici -->
                    <a href="{{ route('profile.edit') }}">
                        <img src="{{ auth()->user()->gravatar() }}" alt="Photo de profil" class="h-8 w-8 rounded-full">
                    </a>
                    <div class="flex items-center mr-5">
                        <div class="rounded border border-gray-400 px-3 py-1 flex items-center">
                            <span class="text-xl font-bold mr-2">{{ auth()->user()->SOLDE }}</span>
                            <span class="text-sm">💰</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row bg-gray-100 dark:bg-gray-700 px-2 mt-1 py-1 rounded-md text-gray-800 dark:text-gray-300">
                    <!-- BARRE DE RECHERCHE -->
                    <input type="text" placeholder="ne fonctionne pas encore"
                           class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-md text-gray-800 dark:text-gray-300" />
                    <a href="search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-300 pt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Votre code actuel pour le menu déroulant des paramètres -->
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <!-- ... (votre code existant) -->
</nav>
