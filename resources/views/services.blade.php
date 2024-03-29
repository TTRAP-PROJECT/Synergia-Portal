<x-app-layout>

    <div
        class="form p-6 py-12 w-1/3 max-w-7xl my-5 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
        @if(session('success')==true)
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if(session('success')==false)
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
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
            <div class="formInput formSubmitButton w-16 text-center">
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

                    {{-- Afficher les événements --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($evenementCinema as $evenementCinemaData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $evenementCinemaData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-red-500 rounded-lg shadow-md p-4 flex flex-col relative h-[210px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">{{ $evenementCinemaData->NOMFILM }}</h2>
                                            <p class="text-gray-200">{{ $evenementCinemaData->LIEUFILM }}</p>
                                            <p class="text-gray-200">Le {{ $evenementCinemaData->DATEHEUREFILM }}</p>
                                        </div>
                                        <div class="absolute bottom-1 right-1">
                                            <img src="/images/cinema.png" class="w-[70px] h-[70px] rounded-full bg-red-400 p-1">
                                        </div>
                                        <button type="submit" class="absolute bottom-1 left-1 bg-red-400 w-[70px] h-[50px] rounded">🛒</button>
                                    </div>

                                </form>
                        @endforeach
                        @foreach ($evenementsSportif as $evenementsSportifData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $evenementsSportifData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-blue-400 rounded-lg shadow-md p-4 flex flex-col relative h-[210px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">
                                                {{ $evenementsSportifData->LIBELLESPORT }}</h2>
                                            <p class="text-gray-200">{{ $evenementsSportifData->LIEUEVENT }}</p>
                                            <p class="text-gray-200">Le {{ $evenementsSportifData->DATEEVENT }}</p>
                                        </div>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="/images/des-sports.png"
                                                class="w-[70px] h-[70px] rounded-full bg-blue-300 p-1">
                                        </div>
                                        <button type="submit" class="absolute bottom-1 left-1 bg-blue-300 w-[70px] h-[50px] rounded">🛒</button>
                                    </div>
                                </form>
                        @endforeach

                        @foreach ($covoiturages as $covoituragesData)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $covoituragesData->IDSERVICE }}" name="idService"/>
                                    <div class="bg-green-500 rounded-lg shadow-md p-4 flex flex-col relative h-[210px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">Convoiturage</h2>
                                            <p class="text-gray-200">
                                                {{ $covoituragesData->LIEUDEPART }}-{{ $covoituragesData->LIEUARRIVE }}</p>
                                            <p class="text-gray-200">Le {{ $covoituragesData->DATECOVOIT }}</p>
                                        </div>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="/images/volant.png"
                                                class="w-[70px] h-[70px] rounded-full bg-green-400 p-1">
                                        </div>
                                        <button type="submit" class="absolute bottom-1 left-1 bg-green-400 w-[70px] h-[50px] rounded">🛒</button>
                                    </div>
                                </form>
                        @endforeach

                        @foreach ($competences as $competence)
                                <form action="{{route('reserverCinema')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $competence->IDSERVICE }}" name="idService"/>
                                    <div class="bg-orange-400 rounded-lg shadow-md p-4 flex flex-col relative h-[210px]">
                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">Echange de compétence</h2>
                                            <p class="text-gray-200">Matière: {{ $competence->MATIERE }}</p>
                                            <p class="text-gray-200">Niveau: {{ $competence->n_i_v_e_a_u->LIBELLENIVEAU }}</p>
                                            <!-- Ajoutez d'autres propriétés de compétence ici si nécessaire -->
                                        </div>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="/images/competence.png"
                                                class="w-[70px] h-[70px] rounded-full bg-orange-300 p-1">
                                        </div>
                                        <button type="submit" class="absolute bottom-1 left-1 bg-orange-300 w-[70px] h-[50px] rounded">🛒</button>
                                    </div>
                                </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
