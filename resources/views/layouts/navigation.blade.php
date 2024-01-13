<nav x-data="{ open: false }" class="bg-white dark:bg-white-800 border-b border-gray-100 dark:border-gray-700 h-20 py-2">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="flex flex-col items-end mr-10 position: fixed right-10">
                <!-- User Logo -->
                <div class="mr-4">
                    <!-- Ajoutez votre logo d'utilisateur ici -->
                    <a href="{{ route('profile.edit') }}">
                        <img src="{{ auth()->user()->gravatar() }}" alt="Photo de profil" class="h-8 w-8 rounded-full">
                    </a>
                </div>

                <div>
                    <!-- BARRE DE RECHERCHE -->
                    <input type="text" placeholder="ne fonctionne pas encore"
                        class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-md text-gray-800 dark:text-gray-300" />
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
