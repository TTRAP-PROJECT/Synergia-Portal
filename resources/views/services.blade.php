<x-app-layout>
    <div class="form">

    </div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            {{-- Afficher les événements --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($evenementCinema as $evenementCinemaData)
                                    <div class="bg-red-500 rounded-lg shadow-md p-4 flex flex-col">

                                        <div class="mt-4">
                                            <h2 class="text-lg font-bold text-white">{{ $evenementCinemaData->NOMFILM }}</h2>
                                            <p class="text-gray-200">{{ $evenementCinemaData->LIEUFILM }}</p>
                                            <p class="text-gray-200">Le {{ $evenementCinemaData->DATEHEUREFILM }}</p>
                                        </div>
                                        <div class="flex items-center justify-end">
                                            <img src="/images/cinema.png" class="w-[70px] h-[70px] rounded-full bg-red-400 p-1">
                                        </div>
                                    </div>

                                @endforeach
                                @foreach ($evenementsSportif as $evenementsSportifData)
                                        <div class="bg-blue-400 rounded-lg shadow-md p-4 flex flex-col">

                                            <div class="mt-4">
                                                <h2 class="text-lg font-bold text-white">{{ $evenementsSportifData->sport->LIBELLESPORT }}</h2>
                                                <p class="text-gray-200">{{ $evenementsSportifData->LIEUEVENT }}</p>
                                                <p class="text-gray-200">Le {{ $evenementsSportifData->DATEEVENT }}</p>
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <img src="/images/des-sports.png" class="w-[70px] h-[70px] rounded-full bg-blue-300 p-1">
                                            </div>
                                        </div>
                                @endforeach
                                @foreach ($covoiturages as $covoituragesData)
                                        <div class="bg-green-400 rounded-lg shadow-md p-4 flex flex-col">

                                            <div class="mt-4">
                                                <h2 class="text-lg font-bold text-white">Convoiturage</h2>
                                                <p class="text-gray-200">{{ $covoituragesData->LIEUDEPART }}-{{ $covoituragesData->LIEUARRIVE }}</p>
                                                <p class="text-gray-200">Le {{ $covoituragesData->DATECOVOIT }}</p>
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <img src="/images/volant.png" class="w-[70px] h-[70px] rounded-full bg-green-300 p-1">
                                            </div>
                                        </div>

                                @endforeach

{{--                                    @foreach ($competences as $competence)--}}
{{--                                        <div class="bg-green-400 rounded-lg shadow-md p-4 flex flex-col">--}}
{{--                                            <div class="mt-4">--}}
{{--                                                <h2 class="text-lg font-bold text-white">Echange de compétence</h2>--}}
{{--                                                <p class="text-gray-200">Matière: {{ $competence->matiere->nom }}</p>--}}
{{--                                                <p class="text-gray-200">Niveau: {{ $competence->niveau->nom }}</p>--}}
{{--                                                <!-- Ajoutez d'autres propriétés de compétence ici si nécessaire -->--}}
{{--                                            </div>--}}
{{--                                            <div class="flex items-center justify-end">--}}
{{--                                                <img src="/images/volant.png" class="w-[70px] h-[70px] rounded-full bg-green-300 p-1">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>



</x-app-layout>
