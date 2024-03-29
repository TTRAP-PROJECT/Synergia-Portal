<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row">
                        <div class="flex flex-col w-5/12">
                            <div class="border p-4">
                                <h2 class="text-xl font-bold mb-4">Sondages</h2>

                                {{-- Affiche les sondages --}}
                                @foreach ($sondages as $sondage)
                                    <div class="mb-4 border p-4 rounded-md bg-gray-100">
                                        <h3 class="text-lg font-bold mb-2">{{ $sondage['NOMSONDAGE'] }}</h3>
                                        {{-- Dates de début et de fin --}}
                                        <div class="text-sm mb-2">
                                            <span class="font-bold">Début:</span>
                                            {{ date('d-m-Y', strtotime($sondage['DATEDEBUT'])) }}
                                        </div>
                                        <div class="text-sm mb-2">
                                            <span class="font-bold">Fin:</span>
                                            {{ date('d-m-Y', strtotime($sondage['DATEFIN'])) }}
                                        </div>
                                        {{-- Barre de progression pour les votes "pour" et "contre" combinés --}}

                                        <div class="flex items-center justify-between mb-2 bg-gray-200 rounded p-2 shadow-md">
                                            <form action="{{ route('vote.pour', ['idSondage' => $sondage['IDSONDAGE']]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm font-bold text-green-600">Pour 🟢 {{ $sondage['POUR'] }}</button>
                                            </form>

                                            <div class="w-1/2 mx-2">
                                                <div class="bg-gray-500 h-4 rounded-full flex">
                                                    <div class="bg-green-600 h-full flex-grow"
                                                        style="width: {{ ($sondage['POUR'] / ($sondage['POUR'] + $sondage['CONTRE'])) * 100 }}%;">
                                                    </div>
                                                    <div class="bg-red-600 h-full flex-grow"
                                                        style="width: {{ ($sondage['CONTRE'] / ($sondage['POUR'] + $sondage['CONTRE'])) * 100 }}%;">
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('vote.contre', ['idSondage' => $sondage['IDSONDAGE']]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm font-bold text-red-600">Contre 🔴 {{ $sondage['CONTRE'] }}</button>
                                            </form>

                                        </div>
                                        {{-- Afficher les messages de réussite spécifiques à ce sondage --}}
                                        @if(Session::has('success') && Session::get('idSondage') == $sondage['IDSONDAGE'])
                                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                                <strong class="font-bold">Succès !</strong>
                                                <span class="block sm:inline">{{ Session::get('success') }}</span>
                                            </div>
                                        @endif
                                        {{-- Afficher les erreurs spécifiques à ce sondage --}}
                                        @if($errors->has('error') && $errors->first('idSondage') == $sondage['IDSONDAGE'])
                                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                                <strong class="font-bold">Erreur !</strong>
                                                <span class="block sm:inline">{{ $errors->first('error') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach




                            </div>

                            <div class="border p-4 mt-4">
                                <div class="flex flex-row items-center justify-between mb-4">
                                    <h2 class="text-xl font-bold">Annonces</h2>
                                    <div class="flex items-center">
                                        <div class="rounded border border-gray-400 px-3 py-1 flex items-center">
                                            <span class="text-xl font-bold mr-2">{{ auth()->user()->SOLDE }}</span>
                                            <span class="text-sm">💰</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Affiche les annonces --}}
                                {{-- @foreach ($annonces as $annonce)
                                    <div class="flex flex-row items-center border-b py-2">
                                        <div class="flex-grow text-sm font-bold">{{ $annonce['TITREANNONCE'] }}</div>
                                        <div class="text-sm font-bold">{{ $annonce['COUTANNONCE'] }} 💰</div>
                                    </div>
                                @endforeach --}}
                            </div>
                        </div>

                        <div class="w-5/12 border">
                            <h2 class="text-xl font-bold mb-4">Evenements</h2>


                            @foreach ($events as $event)
                                @if ($event instanceof \App\Models\CINEMA)

                                    <h3 class="text-lg font-bold text-white-900 dark:text-white mb-2">{{ $event->NOMFILM }}</h3>
                                    <p class="text-sm mb-2">{{ $event->LIEUFILM }}</p>
                                    <p class="text-sm mb-2">{{ $event->DATEHEUREFILM }}</p>

                                @else
                                    <h3 class="text-lg font-bold mb-2">{{ $event->sport->LIBELLESPORT }}</h3>
                                    <p class="text-sm mb-2">{{ $event->LIEUEVENT }}</p>
                                    <p class="text-sm mb-2">Le {{ $event->DATEEVENT }}</p>
                                @endif
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
