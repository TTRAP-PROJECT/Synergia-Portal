<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<x-app-layout>
    @if(session('success') !== null)
        @if(session('success')==true)
            <div class="alert bg-green-500 font-bold rounded alert-success text-center py-3">
                {{ session('message') }}
                {{ session('success') }}
            </div>
        @endif
    @endif
    @if(session('error') !== null)
        @if(session('error')==true)
            <div class="alert bg-red-500 rounded font-bold alert-danger text-center py-3">
                {{ session('error') }}
            </div>
        @endif
    @endif
    <section>
        <div class="py-16">
            <div class="mx-auto px-6 max-w-6xl text-gray-500">
                <div class="relative">
                    <div class="relative z-10 grid gap-3 grid-cols-6">
                        <div
                            class="col-span-full lg:col-span-6 overflow-hidden flex flex-col relative p-6 rounded-xl bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                            <div class="flex flex-row items-center justify-between">
                                <h2 class="text-xl font-bold">Annonces</h2>
                            </div>
                            @foreach ($annonces as $annonce)
                                <div class="flex flex-col items-start border-b">
                                    <div class="flex flex-row items-center py-2">
                                        <div class="flex-grow text-l font-bold">
                                            <a href="#" class="annonce-titre text-gray-600 dark:text-white"
                                               data-description-id="{{ 'description_' . $annonce->ID_ANNONCE }}">⇥ {{ $annonce->TITRE_ANNONCE }}
                                                Le {{ $annonce->DATE_PUBLICATION }}</a>
                                        </div>
                                    </div>
                                    <div id="{{ 'description_' . $annonce->ID_ANNONCE }}"
                                         class="annonce-description hidden text-gray-600 dark:text-white">
                                        {{ $annonce->DESCRIPTION_ANNONCE }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="col-span-full lg:col-span-3 overflow-hidden relative p-8 rounded-xl bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                            <div>
                                <form action="{{ route('create-sondage') }}" method="GET">
                                    <div class="flex flex-row justify-between">
                                        <h2 class="text-xl font-bold mb-4">Sondages</h2>
                                        <button>
                                            <svg class="h-8 w-8 text-white rounded bg-gray-300" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
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

                                        <div
                                            class="flex items-center justify-between mb-2 bg-gray-200 rounded p-2 shadow-md">
                                            <form
                                                action="{{ route('vote.pour', ['idSondage' => $sondage['IDSONDAGE']]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm font-bold text-green-600">Pour
                                                    🟢 {{ $sondage['POUR'] }}</button>
                                            </form>
                                            <div class="w-1/2 mx-2">
                                                <div class="bg-gray-500 h-4 rounded-full flex">
                                                    @php
                                                        $totalVotes = $sondage['POUR'] + $sondage['CONTRE'];
                                                        $pourcentagePour = $totalVotes > 0 ? ($sondage['POUR'] / $totalVotes) * 100 : 0;
                                                        $pourcentageContre = $totalVotes > 0 ? ($sondage['CONTRE'] / $totalVotes) * 100 : 0;
                                                    @endphp
                                                    <div class="bg-green-600 h-full flex-grow"
                                                         style="width: {{ $pourcentagePour }}%;">
                                                    </div>
                                                    <div class="bg-red-600 h-full flex-grow"
                                                         style="width: {{ $pourcentageContre }}%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <form
                                                action="{{ route('vote.contre', ['idSondage' => $sondage['IDSONDAGE']]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm font-bold text-red-600">Contre
                                                    🔴 {{ $sondage['CONTRE'] }}</button>
                                            </form>
                                        </div>
                                        {{-- Afficher les messages de réussite spécifiques à ce sondage --}}
                                        @if(Session::has('success') && Session::get('idSondage') == $sondage['IDSONDAGE'])
                                            <div
                                                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                                role="alert">
                                                <strong class="font-bold">Succès !</strong>
                                                <span class="block sm:inline">{{ Session::get('success') }}</span>
                                            </div>
                                        @endif
                                        {{-- Afficher les erreurs spécifiques à ce sondage --}}
                                        @if($errors->has('error') && $errors->first('idSondage') == $sondage['IDSONDAGE'])
                                            <div
                                                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                                role="alert">
                                                <strong class="font-bold">Erreur !</strong>
                                                <span class="block sm:inline">{{ $errors->first('error') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-span-full lg:col-span-3 overflow-hidden relative p-8 rounded-xl bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                            <h2 class="text-xl font-bold mb-4">Evenements</h2>
                            <div class="flex flex-wrap -mx-4">
                                @foreach ($events as $index => $event)
                                    <div class="w-1/2 px-4 mb-8">
                                        <!-- Your event card code here -->
                                        @if ($event instanceof \App\Models\CINEMA)

                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-500 rounded-lg max-w-xs shadow-lg cinema"
                                                 name="cinema">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                                                     style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                                                          fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                                                         style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/cinema.png" alt="" >
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    @php
                                                        $date = new DateTimeImmutable($event->DATEHEUREFILM);
                                                        $nom = Illuminate\Support\Str::limit($event->NOMFILM, 20);
                                                    @endphp


                                                    <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                                                    <div class="flex justify-between mt-2">

                                                        <span
                                                            class="block bg-white rounded-full text-blue-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $event->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-500 rounded-lg max-w-xs shadow-lg sport"
                                                 name="sport">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                                                     style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                                                          fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                                                         style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/des-sports.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    @php
                                                        $date = new DateTimeImmutable($event->DATEEVENT )
                                                    @endphp

                                                    <span class="block opacity-75 -mb-1 font-bold">{{$event->LIBELLESPORT}}</span>

                                                    <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                                                    <div class="flex justify-between mt-2">

                                                    <span
                                                        class="block bg-white rounded-full text-red-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                                                                    {{ $event->s_e_r_v_i_c_e->prix }}💰
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @if (($index + 1) % 2 == 0)
                                    </div><div class="flex flex-wrap -mx-4">
                                        @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

