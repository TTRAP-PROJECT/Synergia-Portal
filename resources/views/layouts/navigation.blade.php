<nav x-data="{ open: false }"
     class="bg-white dark:bg-white-800 border-b border-gray-100 dark:border-gray-700 h-24 py-2">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex flex-row items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-black dark:text-black"/>
                        <!-- Title -->
                        <div class="ml-2 text-black dark:text-black font-semibold">
                            {{ __('Synergia Portal') }}
                        </div>
                    </a>
                </div>
            </div>
            <!-- User Logo -->
            <div class="items-end mr-5 absolute top-0 right-1 my-5 mr-1 pt-0 flex flex-row-reverse items-center">
                <!-- Ajoutez votre logo d'utilisateur ici -->
                <a href="{{ route('profile.edit') }}">
                    <img src="{{ auth()->user()->gravatar() }}" alt="Photo de profil" class="h-10 w-10 rounded-full">
                </a>
                <div class="flex items-center mr-5">
                    <div class="rounded border border-gray-400 px-3 py-1 flex items-center">
                        <span class="text-xl font-bold mr-2">{{ auth()->user()->SOLDE }}</span>
                        <span class="text-sm">💰</span>
                    </div>
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
