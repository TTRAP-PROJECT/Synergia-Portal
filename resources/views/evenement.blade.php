<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{ route('cours') }}" class="text-blue-900 font-bold">Cours</a>
            <a href="{{ route('covoiturage') }}" class="text-blue-900 font-bold">Covoiturage</a>
            <a href="{{ route('evenements') }}" class="text-blue-900 font-bold">Evenements</a>
            <a href="{{ route('espace_pro') }}" class="text-blue-900 font-bold">Espace Pro</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Fusionner les événements --}}
                    @php
                        $events = $evenementsSportif->merge($evenementCinema)->sortByDesc(function ($event) {
                            return $event instanceof \App\Models\CINEMA ? $event->DATEHEUREFILM : $event->DATEEVENT;
                        });
                    @endphp

                    {{-- Afficher les événements --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($events as $event)
                            <div class="mb-4 border p-4 rounded-md">
                                {{-- Vérifier si l'événement est cinéma --}}
                                @if ($event instanceof \App\Models\CINEMA)
                                    {{-- Afficher les détails du cinéma --}}

                                    <div class="event-box cinema-box bg-blue-200 dark:bg-blue-600 rounded-md p-4 mb-2 custom-background-cinema">
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white">
                                            <h3 class="text-lg font-bold text-white-900 dark:text-white mb-2">{{ $event->NOMFILM }}</h3>
                                            <p class="text-sm mb-2">{{ $event->LIEUFILM }}</p>
                                            <p class="text-sm mb-2">{{ $event->DATEHEUREFILM }}</p>
                                        </div>
                                    </div>

                                @else
                                    {{-- Afficher les détails du sport avec l'image en arrière-plan --}}
                                    <div class="event-box sport-box bg-green-200 dark:bg-green-600 rounded-md p-4 mb-2 relative custom-background-sport">
                                        <div class="absolute inset-0 bg-black opacity-50 rounded-md"></div> <!-- Overlay pour améliorer la lisibilité du texte -->
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white">
                                            <h3 class="text-lg font-bold mb-2">{{ $event->sport->LIBELLESPORT }}</h3>
                                            <p class="text-sm mb-2">{{ $event->LIEUEVENT }}</p>
                                            <p class="text-sm mb-2">Le {{ $event->DATEEVENT }}</p>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
