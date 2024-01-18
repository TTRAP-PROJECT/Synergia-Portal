<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around	">
            <a href="{{ route('cours') }}" class="text-blue-900 font-bold">Cours</a>
            <a href="{{ route('covoiturage') }}" class="text-blue-900 font-bold">Covoiturage</a>
            <a href="{{ route('evenements') }}" class="text-blue-900 font-bold">Evenements</a>
            <a href="{{ route('espace_pro') }}" class="text-blue-900 font-bold">Espace Pro</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Regroupe les blocs d'events, annonces, et sondage de la page d'accueil -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row">
                        <div class="flex flex-col w-5/12">
                            <div class="border">
                                sondages
                            </div>
                            <div class="border">
                                annonces
                                {{-- Affiche les annonces --}}
                                @foreach ($donnees as $annonce)
                                    <div class="flex flex-row">
                                        <div class="text-sm font-bold">
                                            {{ $annonce['TITREANNONCE'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-5/12 border">
                            events
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
