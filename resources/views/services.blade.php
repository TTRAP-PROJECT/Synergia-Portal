<link rel="stylesheet" href="style_service.css">
<x-app-layout>
    @if(session('success') !== null)
        @if(session('success')==true)
            <div class="alert bg-green-500 font-bold rounded alert-success text-center py-3">
                {{ session('message') }}
            </div>
        @else
            <div class="alert bg-red-500 rounded font-bold alert-danger text-center py-3">
                {{ session('message') }}
            </div>
        @endif
    @endif
    <div
        class="form p-6 py-12 w-1/3 max-w-7xl my-5 mx-auto sm:px-6 lg:px-8 bg-gray-400 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">

        <form action="{{ route('services.new') }}" method="POST">
            @csrf
            <div class="form-group">
                <h1 class="text-center text-xl font-bold pb-5">Publier un nouveau service</h1>
                <div class="selectBox flex flex-col">
                    <label for="services">Choisissez le type de service :</label>
                    <Select class="formInput w-60 text-white" list="services" id="service" name="services" onchange="loadAdditionalFields()">
                        <option value="" selected disabled>Choisissez un service</option>
                        <option value="1">Cinéma</option>
                            <option value="2">Covoiturage</option>
                        <option value="3">Échange de compétence</option>
                        <option value="4">Évènement sportif</option>
                        <option value="5">Loisir</option>
                        <option value="6">Autre</option>
                    </Select>
                </div>
            </div>
            <div id="additionalFields">
                <!-- Cette div se remplie par les données chargées dynamiquement; Voir loadAdditionalField() -->
            </div>
            <div class="formInput formSubmitButton w-16 text-center ">
                <button type="submit" id="submitButton" disabled>Publier</button>
            </div>
        </form>
        <script>
            async function loadAdditionalFields() {
                var selectedService = document.getElementById('service').value;
                var additionalFieldsDiv = document.getElementById('additionalFields');
                if (selectedService != '' || selectedService != null) {
                    // Effectuer une requête AJAX pour charger la suite du formulaire en PHP
                    try {
                        const response = await fetch("{{ route('services.datalist') }}?service=" + selectedService);
                        const data = await response.text();
                        additionalFieldsDiv.innerHTML = data;
                        // Appeler votre fichier JavaScript ici
                        var script = document.createElement('script');
                        script.src = "{{ asset('service_formulaire.js') }}";
                        document.body.appendChild(script);
                    } catch (error) {
                        console.error('Une erreur s\'est produite lors du chargement des champs supplémentaires :', error);
                    }
                }
            }
        </script>
    </div>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">--}}

{{--                        @foreach ($evenementCinema as $evenementCinemaData)--}}
{{--                            <form action="{{ route('reserverService') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" value="{{ $evenementCinemaData->IDSERVICE }}" name="idService"/>--}}
{{--                                <div class="relative">--}}
{{--                                    <div class="card">--}}
{{--                                        <img src="/images/cinema.png?auto=compress&cs=tinysrgb&w=1600&lazy=load" class="bg-blue-400 rounded" />--}}
{{--                                        <div class="text-container absolute top-0 left-0 p-4 w-full">--}}
{{--                                            <h2 class="text-lg font-bold text-white">{{ $evenementCinemaData->NOMFILM }}</h2>--}}
{{--                                            <p class="text-gray-200">{{ $evenementCinemaData->LIEUFILM }}</p>--}}
{{--                                            <p class="text-gray-200">Le {{ $evenementCinemaData->DATEHEUREFILM }}</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="button-grp absolute bottom-0 left-0 p-4 w-full">--}}
{{--                                            @if($evenementCinemaData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                <button class="likes disabled" title="Vous avez déjà réservé ce service">🔒</button>--}}
{{--                                            @elseif($evenementCinemaData->getNumberOfReservationsAttribute()>=$evenementCinemaData->s_e_r_v_i_c_e->NBPERSONNESMAX)--}}
{{--                                                <button class="likes disabled" title="Ce service n'est plus disponible">🔒</button>--}}
{{--                                            @else--}}
{{--                                                <button class="likes">Reserver</button>--}}
{{--                                            @endif--}}
{{--                                            <button class="download disabled">--}}
{{--                                                {{ $evenementCinemaData->getNumberOfReservationsAttribute() }}/{{ $evenementCinemaData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤--}}
{{--                                            </button>--}}

{{--                                            @if($evenementCinemaData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                <div class="absolute top-0 right-0">--}}
{{--                                                    🔒--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        @endforeach--}}


{{--                            @foreach ($evenementsSportif as $evenementsSportifData)--}}
{{--                                <form action="{{ route('reserverService') }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" value="{{ $evenementsSportifData->IDSERVICE }}" name="idService"/>--}}
{{--                                    <div class="relative">--}}
{{--                                        <div class="card">--}}
{{--                                            <img src="/images/des-sports.png?auto=compress&cs=tinysrgb&w=1600&lazy=load" class="bg-red-400 rounded" />--}}
{{--                                            <div class="text-container absolute top-0 left-0 p-4 w-full">--}}
{{--                                                <h2 class="text-lg font-bold text-white">{{ $evenementsSportifData->LIBELLESPORT }}</h2>--}}
{{--                                                <p class="text-gray-200">{{ $evenementsSportifData->LIEUEVENT }}</p>--}}
{{--                                                <p class="text-gray-200">Le {{ $evenementsSportifData->DATEEVENT }}</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="button-grp absolute bottom-0 left-0 p-4 w-full">--}}
{{--                                                @if($evenementsSportifData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <button class="likes disabled" title="Vous avez déjà réservé ce service">🔒</button>--}}
{{--                                                @elseif($evenementsSportifData->getNumberOfReservationsAttribute()>=$evenementsSportifData->s_e_r_v_i_c_e->NBPERSONNESMAX)--}}
{{--                                                    <button class="likes disabled" title="Ce service n'est plus disponible">🔒</button>--}}
{{--                                                @else--}}
{{--                                                    <button class="likes">Reserver</button>--}}
{{--                                                @endif--}}
{{--                                                <button class="download disabled">--}}
{{--                                                    {{ $evenementsSportifData->getNumberOfReservationsAttribute() }}/{{ $evenementsSportifData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤--}}
{{--                                                </button>--}}
{{--                                                <!-- Ajout du symbole 🔒 à droite de la division -->--}}
{{--                                                @if($evenementsSportifData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <div class="absolute top-0 right-0">--}}
{{--                                                        🔒--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            @endforeach--}}


{{--                            @foreach ($covoiturages as $covoituragesData)--}}
{{--                                <form action="{{ route('reserverService') }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" value="{{ $covoituragesData->IDSERVICE }}" name="idService"/>--}}
{{--                                    <div class="relative">--}}
{{--                                        <div class="card">--}}
{{--                                            <img src="/images/covoiturage2.png?auto=compress&cs=tinysrgb&w=1600&lazy=load" class="bg-green-400 rounded" />--}}
{{--                                            <div class="text-container absolute top-0 left-0 p-4 w-full">--}}
{{--                                                <h2 class="text-lg font-bold text-white">Convoiturage</h2>--}}
{{--                                                <p class="text-gray-200">{{ $covoituragesData->LIEUDEPART }} - {{ $covoituragesData->LIEUARRIVEE }}</p>--}}
{{--                                                <p class="text-gray-200">Le {{ $covoituragesData->DATECOVOIT }}</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="button-grp absolute bottom-0 left-0 p-4 w-full">--}}
{{--                                                @if($covoituragesData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <button class="likes disabled" title="Vous avez déjà réservé ce service">🔒</button>--}}
{{--                                                @elseif($covoituragesData->getNumberOfReservationsAttribute()>=$covoituragesData->s_e_r_v_i_c_e->NBPERSONNESMAX)--}}
{{--                                                    <button class="likes disabled" title="Ce service n'est plus disponible">🔒</button>--}}
{{--                                                @else--}}
{{--                                                    <button class="likes">Reserver</button>--}}
{{--                                                @endif--}}
{{--                                                <button class="download disabled">--}}
{{--                                                    {{ $covoituragesData->getNumberOfReservationsAttribute() }}/{{ $covoituragesData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤--}}
{{--                                                </button>--}}
{{--                                                <!-- Ajout du symbole 🔒 à droite de la division -->--}}
{{--                                                @if($covoituragesData->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <div class="absolute top-0 right-0">--}}
{{--                                                        🔒--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            @endforeach--}}


{{--                            @foreach ($competences as $competence)--}}
{{--                                <form action="{{ route('reserverService') }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" value="{{ $competence->IDSERVICE }}" name="idService"/>--}}
{{--                                    <div class="relative">--}}
{{--                                        <div class="card">--}}
{{--                                            <img src="/images/competence.png?auto=compress&cs=tinysrgb&w=1600&lazy=load" class="bg-orange-400 rounded" />--}}
{{--                                            <div class="text-container absolute top-0 left-0 p-4 w-full">--}}
{{--                                                <h2 class="text-lg font-bold text-white">Echange de compétence</h2>--}}
{{--                                                <p class="text-gray-200">Matière: {{ $competence->MATIERE }}</p>--}}
{{--                                                <p class="text-gray-200">Niveau: {{ $competence->n_i_v_e_a_u->LIBELLENIVEAU }}</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="button-grp absolute bottom-0 left-0 p-4 w-full">--}}
{{--                                                @if($competence->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <button class="likes disabled" title="Vous avez déjà réservé ce service">🔒</button>--}}
{{--                                                @elseif($competence->getNumberOfReservationsAttribute()>=$competence->s_e_r_v_i_c_e->NBPERSONNESMAX)--}}
{{--                                                    <button class="likes disabled" title="Ce service n'est plus disponible">🔒</button>--}}
{{--                                                @else--}}
{{--                                                    <button class="likes">Reserver</button>--}}
{{--                                                @endif--}}
{{--                                                <button class="download disabled">--}}
{{--                                                    {{ $competence->getNumberOfReservationsAttribute() }}/{{ $competence->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤--}}
{{--                                                </button>--}}
{{--                                                <!-- Ajout du symbole 🔒 à droite de la division -->--}}
{{--                                                @if($competence->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <div class="absolute top-0 right-0">--}}
{{--                                                        🔒--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            @endforeach--}}


{{--                            @foreach ($loisirs as $loisir)--}}
{{--                                <form action="{{ route('reserverService') }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" value="{{ $loisir->IDSERVICE }}" name="idService"/>--}}
{{--                                    <div class="relative">--}}
{{--                                        <div class="card">--}}
{{--                                            <img src="/images/des-sports.png?auto=compress&cs=tinysrgb&w=1600&lazy=load" class="bg-violet-400 rounded" />--}}
{{--                                            <div class="text-container absolute top-0 left-0 p-4 w-full">--}}
{{--                                                <h2 class="text-lg font-bold text-white">Loisir</h2>--}}
{{--                                                <p class="text-gray-200">{{ $loisir->LIBELLELOISIR }}</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="button-grp absolute bottom-0 left-0 p-4 w-full">--}}
{{--                                                @if($loisir->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <button class="likes disabled" title="Vous avez déjà réservé ce service">🔒</button>--}}
{{--                                                @elseif($loisir->getNumberOfReservationsAttribute()>=$loisir->s_e_r_v_i_c_e->NBPERSONNESMAX)--}}
{{--                                                    <button class="likes disabled" title="Ce service n'est plus disponible">🔒</button>--}}
{{--                                                @else--}}
{{--                                                    <button class="likes">Reserver</button>--}}
{{--                                                @endif--}}
{{--                                                <button class="download disabled">--}}
{{--                                                    {{ $loisir->getNumberOfReservationsAttribute() }}/{{ $loisir->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤--}}
{{--                                                </button>--}}
{{--                                                <!-- Ajout du symbole 🔒 à droite de la division -->--}}
{{--                                                @if($loisir->hasReservations(Auth::user()->IDUTILISATEUR))--}}
{{--                                                    <div class="absolute top-0 right-0">--}}
{{--                                                        🔒--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            @endforeach--}}

                            <div class="p-24 flex flex-wrap items-center justify-center">
                                    @foreach ($evenementCinema as $evenementCinemaData)
{{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                                            @csrf
                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-500 rounded-lg max-w-xs shadow-lg">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/cinema.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    @php
                                                        $date = new DateTimeImmutable($evenementCinemaData->DATEHEUREFILM)
                                                    @endphp
                                                    <input type="hidden" value="{{ $evenementCinemaData->IDSERVICE }}" name="idService"/>

                                                    <span class="block opacity-75 -mb-1">{{ $evenementCinemaData->LIEUFILM }}</span>
                                                    <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                                                    <div class="flex justify-between mt-2">

                                                        <button onclick="openModal('{{ $evenementCinemaData->IDSERVICE }}')">
                                                            <!-- Icône "+" -->
                                                            <svg class="h-8 w-8 text-blue-500 bg-white rounded"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </button>
                                                        <span class="block bg-white rounded-full text-blue-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $evenementCinemaData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        </form>--}}
                                    @endforeach
                                    @foreach ($evenementsSportif as $evenementsSportifData)
{{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                                            @csrf

                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-500 rounded-lg max-w-xs shadow-lg">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/des-sports.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    @php
                                                        $date = new DateTimeImmutable($evenementsSportifData->DATEEVENT )
                                                    @endphp
                                                    <input type="hidden" value="{{ $evenementsSportifData->IDSERVICE }}" name="idService"/>

                                                    <span class="block opacity-75 -mb-1">{{ $evenementsSportifData->LIEUEVENT }}</span>
                                                    <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                                                    <div class="flex justify-between mt-2">

                                                        <button onclick="openModal('{{ $evenementsSportifData->IDSERVICE }}')">
                                                            <!-- Icône "+" -->
                                                            <svg class="h-8 w-8 text-red-500 bg-white rounded"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </button>
                                                        <span class="block bg-white rounded-full text-red-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $evenementsSportifData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        </form>--}}
                                    @endforeach
                                    @foreach($covoiturages as $covoituragesData)
{{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                                            @csrf
                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-green-500 rounded-lg max-w-xs shadow-lg">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/covoiturage2.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    <input type="hidden" value="{{ $covoituragesData->IDSERVICE }}" name="idService"/>
                                                    <span class="block opacity-75 -mb-1">De {{ $covoituragesData->LIEUDEPART }} </span>
                                                    <span class="block opacity-75 -mb-1">A {{ $covoituragesData->LIEUARRIVEE }}</span>

                                                    <div class="flex justify-between mt-2">

                                                        <button onclick="openModal('{{ $covoituragesData->IDSERVICE }}')">
                                                            <!-- Icône "+" -->
                                                            <svg class="h-8 w-8 text-green-500 bg-white rounded"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </button>
                                                        <span class="block bg-white rounded-full text-green-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $covoituragesData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        </form>--}}
                                    @endforeach
                                    @foreach($competences as $competence)
{{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                                            @csrf
                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/competence.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    <input type="hidden" value="{{ $competence->IDSERVICE }}" name="idService"/>
                                                    <span class="block opacity-75 -mb-1">Matiere: {{ $competence->MATIERE }}</span>
                                                    <span class="block opacity-75 -mb-1">Niveau: {{ $competence->n_i_v_e_a_u->LIBELLENIVEAU }}</span>
                                                    <div class="flex justify-between mt-2">

                                                        <button onclick="openModal('{{ $competence->IDSERVICE }}')">
                                                            <!-- Icône "+" -->
                                                            <svg class="h-8 w-8 text-orange-500 bg-white rounded"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </button>
                                                        <span class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $competence->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        </form>--}}
                                    @endforeach
                                    @foreach ($loisirs as $loisir)
{{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                                            @csrf
                                            <div class="flex-shrink-0 m-6 relative overflow-hidden bg-purple-500 rounded-lg max-w-xs shadow-lg">
                                                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                                                </svg>
                                                <div class="relative pt-10 px-10 flex items-center justify-center">
                                                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                                                    <img class="relative w-40" src="/images/des-sports.png" alt="">
                                                </div>
                                                <div class="relative text-white px-6 pb-6 mt-6">
                                                    @php
                                                        $date = new DateTimeImmutable($loisir->s_e_r_v_i_c_e->DATEPREVUE)
                                                    @endphp
                                                    <input type="hidden" value="{{ $loisir->IDSERVICE }}" name="idService"/>
                                                    <span class="block opacity-75 -mb-1">{{ $loisir->LIBELLELOISIR }}</span>
                                                    <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>
                                                    <div class="flex justify-between mt-2">
                                                        <button onclick="openModal('{{ $loisir->IDSERVICE }}')">
                                                            <!-- Icône "+" -->
                                                            <svg class="h-8 w-8 text-purple-500 bg-white rounded"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </button>

                                                        <span class="block bg-white rounded-full text-purple-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $loisir->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        </form>--}}
                                    @endforeach
                            </div>





        {{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>

<style>
    dialog[open] {
        animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
    }

    dialog::backdrop {
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
        backdrop-filter: blur(3px);
    }

    @keyframes appear {
        from {
            opacity: 0;
            transform: translateX(-3rem);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

{{--<section class="flex h-screen w-screen p-10 justify-center items-start">--}}
{{--    <button onclick="openModal()" id="btn" class="py-3 px-10 bg-gray-800 text-white rounded text shadow-xl">Open</button>--}}
{{--</section>--}}

<dialog id="myModal" class="h-auto w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
    <div class="flex flex-col w-full h-auto">
        <!-- Header -->
        <div class="flex w-full h-auto justify-center items-center">
            <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                Réserver le service
            </div>
            <div onclick="document.getElementById('myModal').close();" class="flex w-1/12 h-auto justify-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
            <!--Header End-->
        </div>
        <!-- Modal Content-->
        <div id="modalContent" class="flex w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
           Chargement ...
        </div>
        <!-- End of Modal Content-->
    </div>
</dialog>
<script>
    function openModal(idService) {
        // Afficher le modal
        document.getElementById('myModal').showModal();

        // Récupérer les informations du service via une requête fetch
        fetch(`/ValidationServices/${idService}`)
            .then(result => result.text())
            .then(data => {
                // Mettre les informations dans le contenu du modal
                document.getElementById('modalContent').innerHTML = data;
            })
            .catch(error => console.error('Une erreur est survenue :', error));
    }
</script>

