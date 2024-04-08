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
    <div class="grid grid-cols-3 gap-4">
        <div
            class="flex flex-row bg-gray-100 dark:bg-gray-700 px-2 mt-1 py-1 rounded-md text-gray-800 dark:text-gray-300">
            <!-- BARRE DE RECHERCHE -->
            <input type="text" placeholder="ne fonctionne pas encore"
                   class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-md text-gray-800 dark:text-gray-300"/>
            <a href="search">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-300 pt-1"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a4 4 0 11-8 0 4 4 0 018 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35"/>
                </svg>
            </a>
        </div>
        <div
            class="form p-6 py-12 w-full max-w-7xl my-5 mx-auto sm:px-6 lg:px-8 bg-gray-400 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">

            <form action="{{ route('services.new') }}" method="POST">
                @csrf
                <div class="form-group">
                    <h1 class="text-center text-xl font-bold pb-5">Publier un nouveau service</h1>
                    <div class="selectBox flex flex-col">
                        <label for="services">Choisissez le type de service :</label>
                        <Select class="formInput w-60 text-white" list="services" id="service" name="services"
                                onchange="loadAdditionalFields()">
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
    </div>

    <div class="p-24 flex flex-wrap items-center justify-center">
        @foreach ($evenementCinema as $evenementCinemaData)
            @if($evenementCinemaData->s_e_r_v_i_c_e->IDSTATUT == 1)
                {{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                @csrf
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-500 rounded-lg max-w-xs shadow-lg">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                         style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                              fill="white"/>
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                             style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                        <img class="relative w-40" src="/images/cinema.png" alt="">
                    </div>
                    <div class="relative text-white px-6 pb-6 mt-6">
                        @php
                            $date = new DateTimeImmutable($evenementCinemaData->DATEHEUREFILM);
                            $nom = Illuminate\Support\Str::limit($evenementCinemaData->NOMFILM, 20);
                        @endphp
                        <input type="hidden" value="{{ $evenementCinemaData->IDSERVICE }}" name="idService"/>

                        <span class="block opacity-75 -mb-1 font-bold">{{ $nom }}</span>
                        <span class="block opacity-75 -mb-1">{{ $evenementCinemaData->LIEUFILM }}</span>
                        <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                        <div class="flex justify-between mt-2">

                            <button onclick="openModal('{{ $evenementCinemaData->IDSERVICE }}')">
                                <!-- Icône "+" -->
                                <svg class="h-8 w-8 text-blue-500 bg-white rounded" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                            <span
                                class="block bg-white rounded-full text-blue-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $evenementCinemaData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                        </div>
                    </div>
                </div>
                {{--                                        </form>--}}
            @endif
        @endforeach
        @foreach ($evenementsSportif as $evenementsSportifData)
            @if($evenementsSportifData->s_e_r_v_i_c_e->IDSTATUT == 1)
                {{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                @csrf

                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-500 rounded-lg max-w-xs shadow-lg">
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
                            $date = new DateTimeImmutable($evenementsSportifData->DATEEVENT )
                        @endphp
                        <input type="hidden" value="{{ $evenementsSportifData->IDSERVICE }}" name="idService"/>

                        <span class="block opacity-75 -mb-1 font-bold">{{$evenementsSportifData->LIBELLESPORT}}</span>
                        <span class="block opacity-75 -mb-1">{{ $evenementsSportifData->LIEUEVENT }}</span>
                        <span class="block opacity-75 -mb-1">Le {{ $date->format('d-m-Y') }}</span>

                        <div class="flex justify-between mt-2">

                            <button onclick="openModal('{{ $evenementsSportifData->IDSERVICE }}')">
                                <!-- Icône "+" -->
                                <svg class="h-8 w-8 text-red-500 bg-white rounded" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                            <span
                                class="block bg-white rounded-full text-red-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $evenementsSportifData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                        </div>
                    </div>
                </div>
                {{--                                        </form>--}}
            @endif
        @endforeach
        @foreach($covoiturages as $covoituragesData)
            @if($covoituragesData->s_e_r_v_i_c_e->IDSTATUT == 1)
                {{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                @csrf
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-green-500 rounded-lg max-w-xs shadow-lg">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                         style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                              fill="white"/>
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                             style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                        <img class="relative w-40" src="/images/covoiturage2.png" alt="">
                    </div>
                    <div class="relative text-white px-6 pb-6 mt-6">
                        <input type="hidden" value="{{ $covoituragesData->IDSERVICE }}" name="idService"/>
                        <span class="block opacity-75 -mb-1">De : {{ $covoituragesData->LIEUDEPART }} </span>
                        <span class="block opacity-75 -mb-1">À : {{ $covoituragesData->LIEUARRIVEE }}</span>

                        <div class="flex justify-between mt-2">

                            <button onclick="openModal('{{ $covoituragesData->IDSERVICE }}')">
                                <!-- Icône "+" -->
                                <svg class="h-8 w-8 text-green-500 bg-white rounded" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                            <span
                                class="block bg-white rounded-full text-green-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $covoituragesData->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                        </div>
                    </div>
                </div>
                {{--                                        </form>--}}
            @endif
        @endforeach
        @foreach($competences as $competence)
            @if($competence->s_e_r_v_i_c_e->IDSTATUT == 1)
                {{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                @csrf
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                         style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                              fill="white"/>
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                             style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                        <img class="relative w-40" src="/images/competence.png" alt="">
                    </div>
                    <div class="relative text-white px-6 pb-6 mt-6">
                        <input type="hidden" value="{{ $competence->IDSERVICE }}" name="idService"/>
                        <span class="block opacity-75 -mb-1">Matiere: {{ $competence->MATIERE }}</span>
                        <span
                            class="block opacity-75 -mb-1">Niveau: {{ $competence->n_i_v_e_a_u->LIBELLENIVEAU }}</span>
                        <div class="flex justify-between mt-2">

                            <button onclick="openModal('{{ $competence->IDSERVICE }}')">
                                <!-- Icône "+" -->
                                <svg class="h-8 w-8 text-orange-500 bg-white rounded" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                            <span
                                class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $competence->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                        </div>
                    </div>
                </div>
                {{--                                        </form>--}}
            @endif
        @endforeach
        @foreach ($loisirs as $loisir)
            @if($loisir->s_e_r_v_i_c_e->IDSTATUT == 1)
                {{--                                        <form action="{{ route('reserverService') }}" method="POST">--}}
                @csrf
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-purple-500 rounded-lg max-w-xs shadow-lg">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                         style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                              fill="white"/>
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                             style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                        <img class="relative w-40" src="/images/loisirs.png" alt="">
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
                                <svg class="h-8 w-8 text-purple-500 bg-white rounded" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>

                            <span
                                class="block bg-white rounded-full text-purple-500 text-xs font-bold px-3 py-2 leading-none flex items-center">
                                                            {{ $loisir->s_e_r_v_i_c_e->prix }}💰
                                                        </span>
                        </div>
                    </div>
                </div>
                {{--                                        </form>--}}
            @endif
        @endforeach
    </div>
</x-app-layout>


<dialog id="myModal" class=" w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
    <div class="flex flex-col w-full h-auto">
        <!-- Header -->
        <div class="flex w-full h-auto justify-center items-center">
            <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                Réserver le service
            </div>
            <div onclick="document.getElementById('myModal').close();"
                 class="flex w-1/12 justify-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
            <!--Header End-->
        </div>
        <!-- Modal Content-->
        <div id="modalContent">
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

