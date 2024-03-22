<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Fusionner les événements --}}
                    @php
                        $events = $evenementsSportif->merge($evenementCinema)->sortByDesc('DATEEVENT');
                    @endphp

                    {{-- Afficher les événements --}}
                    <div class="grid grid-cols-4 gap-6">
                        @foreach ($events as $event)
                            <div class="mb-4 border p-4 rounded-md bg-gray-100 col-span-1">
                                {{-- Vérifier si l'événement est cinéma --}}
                                @if ($event instanceof \App\Models\CINEMA)
                                    {{-- Afficher les détails du cinéma --}}
                                    <h3 class="text-lg font-bold mb-2">{{ $event->NOMFILM }}</h3>
                                    <p class="text-sm mb-2">Lieu du film: {{ $event->LIEUFILM }}</p>
                                    <p class="text-sm mb-2">Date et heure du film: {{ $event->DATEHEUREFILM }}</p>
                                @else
                                    {{-- Afficher les détails du sport --}}
                                    <h3 class="text-lg font-bold mb-2">{{ $event->sport->LIBELLESPORT }}</h3>
                                    <p class="text-sm mb-2">ID Service: {{ $event->IDSERVICE }}</p>
                                    <p class="text-sm mb-2">Date de l'événement: {{ $event->DATEEVENT }}</p>
                                @endif
                                <!-- Ajouter ici des boutons ou des liens pour effectuer des actions sur l'événement -->
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                                    Action
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
