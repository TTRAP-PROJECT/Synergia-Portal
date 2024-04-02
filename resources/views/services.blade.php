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
    <div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
{{--                    @php var_dump($services)@endphp--}}
                    {{-- Afficher les événements --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($evenementCinema as $evenementCinemaData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $evenementCinemaData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-red-500 rounded-lg shadow-md p-4 flex flex-col relative h-[250px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">{{ $evenementCinemaData->NOMFILM }}</h2>
                                            <p class="text-gray-200">{{ $evenementCinemaData->LIEUFILM }}</p>
                                            <p class="text-gray-200">Le {{ $evenementCinemaData->DATEHEUREFILM }}</p>

                                        </div>
                                        <div class="absolute bottom-1 right-1">
                                            <p class="text-gray-200 right-0">{{$evenementCinemaData->getNumberOfReservationsAttribute()}}/{{ $evenementCinemaData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤</p>
                                            <img src="/images/cinema.png" class="w-[70px] h-[70px] rounded bg-red-400 p-1">
                                        </div>
                                        @if($evenementCinemaData->hasReservations(Auth::user()->IDUTILISATEUR))
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Vous avez déja réservé ce service" >🔒</button>
                                        @elseif($evenementCinemaData->getNumberOfReservationsAttribute()>=$evenementCinemaData->s_e_r_v_i_c_e->NBPERSONNESMAX)
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Ce service n'est plus disponible" >🔒</button>
                                        @else
                                            <button type="submit" class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded">🛒</button>
                                        @endif
                                    </div>

                                </form>
                        @endforeach
                        @foreach ($evenementsSportif as $evenementsSportifData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $evenementsSportifData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-blue-400 rounded-lg shadow-md p-4 flex flex-col relative h-[250px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">
                                                {{ $evenementsSportifData->LIBELLESPORT }}</h2>
                                            <p class="text-gray-200">{{ $evenementsSportifData->LIEUEVENT }}</p>
                                            <p class="text-gray-200">Le {{ $evenementsSportifData->DATEEVENT }}</p>

                                        </div>
                                        <div class="absolute bottom-1 right-1">
                                            <p class="text-gray-200 right-0">{{$evenementsSportifData->getNumberOfReservationsAttribute()}}/{{ $evenementsSportifData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤 </p>

                                            <img src="/images/des-sports.png" class="w-[70px] h-[70px] rounded bg-blue-300 p-1">

                                        </div>
                                        @if($evenementsSportifData->hasReservations(Auth::user()->IDUTILISATEUR))
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Vous avez déja réservé ce service" >🔒</button>
                                        @elseif($evenementsSportifData->getNumberOfReservationsAttribute()>=$evenementsSportifData->s_e_r_v_i_c_e->NBPERSONNESMAX)
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Ce service n'est plus disponible" >🔒</button>
                                        @else
                                            <button type="submit" class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded">🛒</button>
                                        @endif
                                    </div>
                                </form>
                        @endforeach

                        @foreach ($covoiturages as $covoituragesData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $covoituragesData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-green-500 rounded-lg shadow-md p-4 flex flex-col relative h-[250px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">Convoiturage</h2>
                                            <p class="text-gray-200">
                                                {{ $covoituragesData->LIEUDEPART }}-{{ $covoituragesData->LIEUARRIVEE }}</p>
                                            <p class="text-gray-200">Le {{ $covoituragesData->DATECOVOIT }}</p>
                                            </div>
                                        <div class="absolute bottom-1 right-1">
                                            <p class="text-gray-200 right-0">{{$covoituragesData->getNumberOfReservationsAttribute()}}/{{ $covoituragesData->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤 </p>

                                            <img src="/images/volant.png"
                                                class="w-[70px] h-[70px] rounded bg-green-400 p-1">
                                        </div>
                                        @if($covoituragesData->hasReservations(Auth::user()->IDUTILISATEUR))
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Vous avez déja réservé ce service" >🔒</button>
                                        @elseif($covoituragesData->getNumberOfReservationsAttribute()>=$covoituragesData->s_e_r_v_i_c_e->NBPERSONNESMAX)
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Ce service n'est plus disponible" >🔒</button>
                                        @else
                                            <button type="submit" class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded">🛒</button>
                                        @endif
                                    </div>
                                </form>
                        @endforeach

                        @foreach ($competences as $competence)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $competence->IDSERVICE }}" name="idService"/>
                                    <div class="bg-orange-400 rounded-lg shadow-md p-4 flex flex-col relative h-[250px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">Echange de compétence</h2>
                                            <p class="text-gray-200">Matière: {{ $competence->MATIERE }}</p>
                                            <p class="text-gray-200">Niveau: {{ $competence->n_i_v_e_a_u->LIBELLENIVEAU }}</p>
                                             <!-- Ajoutez d'autres propriétés de compétence ici si nécessaire -->
                                        </div>
                                        <div class="absolute bottom-1 right-1">

                                            <p class="text-gray-200 right-0">{{$competence->getNumberOfReservationsAttribute()}}/{{ $competence->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤</p>

                                            <img src="/images/competence.png"
                                                class="w-[70px] h-[70px] rounded bg-orange-300 p-1">
                                        </div>
                                        @if($competence->hasReservations(Auth::user()->IDUTILISATEUR))
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Vous avez déja réservé ce service" >🔒</button>
                                        @elseif($competence->getNumberOfReservationsAttribute()>=$competence->s_e_r_v_i_c_e->NBPERSONNESMAX)
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Ce service n'est plus disponible" >🔒</button>
                                        @else
                                            <button type="submit" class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded">🛒</button>
                                        @endif
                                    </div>
                                </form>
                        @endforeach

                            @foreach ($loisirs as $loisir)
                                <form action="{{route('reserverLoisir')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $loisir->IDSERVICE }}" name="idService"/>
                                    <div class="bg-violet-400 rounded-lg shadow-md p-4 flex flex-col relative h-[250px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">Loisir</h2>
                                            <p class="text-gray-200">{{ $loisir->LIBELLELOISIR }}</p>
                                            <!-- Ajoutez d'autres propriétés de compétence ici si nécessaire -->
                                        </div>
                                        <div class="absolute bottom-1 right-1">

                                            <p class="text-gray-200 right-0">{{$loisir->getNumberOfReservationsAttribute()}}/{{ $loisir->s_e_r_v_i_c_e->NBPERSONNESMAX }}👤</p>

                                            <img src="/images/competence.png"
                                                 class="w-[70px] h-[70px] rounded bg-violet-300 p-1">
                                        </div>
                                        @if($loisir->hasReservations(Auth::user()->IDUTILISATEUR))
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Vous avez déja réservé ce service" >🔒</button>
                                        @elseif($loisir->getNumberOfReservationsAttribute()>=$loisir->s_e_r_v_i_c_e->NBPERSONNESMAX)
                                            <button disabled class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded " title="Ce service n'est plus disponible" >🔒</button>
                                        @else
                                            <button type="submit" class="absolute bottom-1 left-1 bg-white w-[70px] h-[50px] rounded">🛒</button>
                                        @endif
                                    </div>
                                </form>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
