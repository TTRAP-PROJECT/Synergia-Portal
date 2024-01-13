<x-app-layout>
    <x-slot name="header">
        <a href="" class="text-blue-900 font-bold">Cours</a>
        <a href="" class="text-blue-900 font-bold">Covoiturage</a>
        <a href="" class="text-blue-900 font-bold">Evenement</a>
        <a href="" class="text-blue-900 font-bold">Espace Pro</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <!-- Regroupe les blocs d'events, annonces, et sondage de la page d'accueil -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row">
                        <div class="flex flex-col w-5/12">
                            <div>
                                sondages
                            </div>
                            <div>
                                annonces
                            </div>
                        </div>
                        <div class="w-5/12">
                            events
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>