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
                                            <span class="font-bold">Début:</span> {{ date('d-m-Y', strtotime($sondage['DATEDEBUT'])) }}
                                        </div>
                                        <div class="text-sm mb-2">
                                            <span class="font-bold">Fin:</span> {{ date('d-m-Y', strtotime($sondage['DATEFIN'])) }}
                                        </div>

                                        {{-- Barre de progression pour les votes "pour" et "contre" combinés --}}
                                        <div class="flex items-center mb-2 bg-gray-200 rounded p-2 shadow-md">
                                            <div class="w-1/4 text-sm font-bold text-green-600">Pour 🟢 {{ $sondage['POUR'] }}</div>
                                            <div class="w-1/2 mx-2">
                                                <div class="bg-gray-500 h-4 rounded-full flex">
                                                    <div class="bg-green-600 h-full flex-grow" style="width: {{ ($sondage['POUR'] / ($sondage['POUR'] + $sondage['CONTRE'])) * 100 }}%;"></div>
                                                    <div class="bg-red-600 h-full flex-grow" style="width: {{ ($sondage['CONTRE'] / ($sondage['POUR'] + $sondage['CONTRE'])) * 100 }}%;"></div>
                                                </div>
                                            </div>
                                            <div class="w-1/4 text-sm font-bold text-red-600 text-right">Contre 🔴 {{ $sondage['CONTRE'] }}</div>
                                        </div>
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
                                @foreach ($donnees as $annonce)
                                    <div class="flex flex-row items-center border-b py-2">
                                        <div class="flex-grow text-sm font-bold">{{ $annonce['TITREANNONCE'] }}</div>
                                        <div class="text-sm font-bold">{{ $annonce['COUTANNONCE'] }} 💰</div>
                                    </div>
                                @endforeach
                            </div>




                        </div>

                        <div class="w-5/12 border">
                            Event
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
