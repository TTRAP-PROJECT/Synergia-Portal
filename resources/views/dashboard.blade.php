<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row">
                        <div class="flex flex-col w-5/12">
                            <div class="border p-4">
                                <h2 class="text-xl font-bold mb-4">Sondages</h2>
@php
if (count($sondages)==0){ echo "Aucun sondage en cours";}
                                @endphp
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
                                                    @php
                                                        $totalVotes = $sondage['POUR'] + $sondage['CONTRE'];
                                                        $pourcentagePour = $totalVotes > 0 ? ($sondage['POUR'] / $totalVotes) * 100 : 0;
                                                        $pourcentageContre = $totalVotes > 0 ? ($sondage['CONTRE'] / $totalVotes) * 100 : 0;
                                                    @endphp

                                                    <div class="bg-green-600 h-full flex-grow" style="width: {{ $pourcentagePour }}%;">
                                                    </div>
                                                    <div class="bg-red-600 h-full flex-grow" style="width: {{ $pourcentageContre }}%;">
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
                                </div>

                                @foreach ($annonces as $annonce)
                                    <div class="flex flex-row items-center border-b py-2">
                                        <div class="flex-grow text-l font-bold">
                                            <a href="#" class="annonce-titre" data-description-id="{{ 'description_' . $annonce->ID_ANNONCE }}">⇥ {{ $annonce->TITRE_ANNONCE }}</a>
                                        </div>
                                        <div class="text-sm font-bold">Le {{ $annonce->DATE_PUBLICATION }}</div>
                                    </div>
                                    <div id="{{ 'description_' . $annonce->ID_ANNONCE }}" class="annonce-description hidden">
                                        {{ $annonce->DESCRIPTION_ANNONCE }}
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <div class="w-5/12 border p-4">
                            <h2 class="text-xl font-bold mb-4">Evenements</h2>

                            @foreach ($events as $event)
                                <div class="bg-gray-100 rounded-lg p-4 mb-4">
                                    @if ($event instanceof \App\Models\CINEMA)
                                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">{{ $event->NOMFILM }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $event->LIEUFILM }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $event->DATEHEUREFILM }}</p>
                                    @else
                                        <h3 class="text-lg font-bold mb-2">{{ $event->LIBELLESPORT }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $event->LIEUEVENT }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Le {{ $event->DATEEVENT }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
