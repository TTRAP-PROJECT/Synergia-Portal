<x-app-layout>
    @if(session('success') !== null)
        @if(session('success')==true)
            <div class="alert bg-green-500 font-bold rounded alert-success text-center py-3">
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

    <div class="flex flex-col h-screen bg-gray-100">

        <!-- Barra de navegación superior -->
        <div class="bg-white text-white shadow w-full p-2 flex items-center justify-between">

            <!-- Ícono de Notificación y Perfil -->
            <div class="space-x-5">
                <button>
                    <i class="fas fa-bell text-gray-500 text-lg"></i>
                </button>
                <!-- Botón de Perfil -->
                <button>
                    <i class="fas fa-user text-gray-500 text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-wrap border-2">
            <!-- Barra lateral de navegación (oculta en dispositivos pequeños) -->
            <div class="p-2 bg-white w-full md:w-60 flex flex-col md:flex hidden" id="sideNav">
                <nav>
                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="#">
                        <i class="fas fa-home mr-2"></i>Graphiques des réservations
                    </a>
                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="#">
                        <i class="fas fa-home mr-2"></i>Nombre de réservations
                    </a>
                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="#">
                        <i class="fas fa-file-alt mr-2"></i>Services des utilisateurs
                    </a>
                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="#">
                        <i class="fas fa-users mr-2"></i>Transaction
                    </a>

                </nav>

                <!-- Ítem de Cerrar Sesión -->
                <a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto" href="#">
                    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión
                </a>



            </div>

            <!-- Área de contenido principal -->
            <div class="flex-1 p-4 w-full md:w-1/2">



                <div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">

                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">Graphiques des services</h2>
                        <div class="my-1"></div>
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> <!-- Línea con gradiente -->
                        <div class="chart-container" style="position: relative; height:150px; width:100%">

                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>

                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">Nombre de réservations</h2>
                        <div class="my-1"></div> <!-- Espacio de separación -->
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> <!-- Línea con gradiente -->
                        <div class="chart-container" style="position: relative; height:150px; width:100%">
                            <!-- El canvas para la gráfica -->
                            <canvas id="commercesChart"></canvas>
                        </div>
                    </div>




                </div>

                <!-- Tercer contenedor debajo de los dos anteriores -->
                <!-- Sección 3 - Tabla de Autorizaciones Pendientes -->
                <div class="mt-8 bg-white p-4 shadow rounded-lg">
                    <h2 class="text-gray-500 text-lg font-semibold pb-4">Services des utilisateurs</h2>
                    <div class="my-1"></div> <!-- Espacio de separación -->
                    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> <!-- Línea con gradiente -->
                    <table class="w-full table-auto text-sm">
                        <thead>
                        <tr class="text-sm leading-normal">
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Icone</th>
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Vendeur</th>
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Service</th>
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Prix</th>
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Date de publication</th>
                        </tr>
                        </thead>
                        <tbody >
                            @foreach ($services as $service)
                                <form action="{{ route('desactiverService') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $service->IDSERVICE }}" name="idService"/>
                                    @if($service->IDSTATUT==4)
                                        <tr class="hover:bg-grey-lighter bg-red-300">
                                    @else
                                        <tr class="hover:bg-grey-lighter">
                                    @endif
                                        <td class="py-2 px-4 border-b border-grey-light">
                                            <img src="{{ $service->vendeur->gravatar(200) }}" alt="Gravatar" width="40" height="40">
                                        </td>
                                        <td class="py-2 px-4 border-b border-grey-light">{{ $service->vendeur->NOMUTILISATEUR." ".$service->vendeur->PRENOMUTILISATEUR }}</td>
                                        <td class="py-2 px-4 border-b border-grey-light">{{ $service->LIBELLESERVICE }}</td>
                                        <td class="py-2 px-4 border-b border-grey-light">{{ $service->prix }}💰</td>

                                        @php
                                            $date = new DateTimeImmutable($service->DATEPUBLICATION )
                                        @endphp
                                        <td class="py-2 px-4 border-b border-grey-light">Le {{ $date->format('d-m-Y')." à ".$date->format('H')."h".$date->format('m') }}  </td>
                                        <td><div class="item-center middle none center flex justify-center rounded-lg bg-gray-500 p-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none expand-button" data-ripple-light="true" style="position: relative; overflow: hidden;">…</div></td>
                                        <td><button class="item-center middle none center flex justify-center rounded-lg bg-red-500 p-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true" style="position: relative; overflow: hidden;">X</button></td>
                                    </tr>
                                    <tr class="hidden ">
                                        <td colspan="6" class="border-b border-grey-light"> <!-- Ajoutez une cellule vide avec colspan="6" pour aligner les données supplémentaires -->
                                            <div class="flex flex-row justify-between">
                                                <div class="py-2 px-4"> <strong>Description:</strong> {{ $service->description }}</div>
                                                <div class="py-2 px-4 "> <strong>Date Prévu:</strong> {{ $service->DATEPREVUE }}</div>
                                            </div>

                                            <div class="flex flex-row justify-between">
                                                <div class="py-2 px-4 "> <strong>{{$service->getNumberOfReservationsAttribute()."/".$service->NBPERSONNESMAX }}👤</strong></div>
                                                <div class="py-2 px-4 "> <strong>Lieu:</strong> "{{ $service->LIEU_SERVICE }}"</div>
                                            </div>




                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="mt-4">
                        {{ $services->links() }}
                    </div>


                </div>

                <!-- Cuarto contenedor -->
                <!-- Sección 4 - Tabla de Transacciones -->
                <div class="mt-8 bg-white p-4 shadow rounded-lg">
                    <div class="bg-white p-4 rounded-md mt-4">
                        <h2 class="text-gray-500 text-lg font-semibold pb-4">Transaction</h2>
                        <div class="my-1"></div> <!-- Espacio de separación -->
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> <!-- Línea con gradiente -->
                        <table class="w-full table-auto text-sm">
                            <thead>

                                    <tr class="text-sm leading-normal">
                                        <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Utilisateur</th>
                                        <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Date de transaction</th>
                                        <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Montant</th>
                                    </tr>

                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-2 px-4 border-b border-grey-light">{{$log->utilisateur->NOMUTILISATEUR." ".$log->utilisateur->PRENOMUTILISATEUR }}</td>
                                    <td class="py-2 px-4 border-b border-grey-light">{{$log->DATEPAYEMENT}}</td>
                                    <td class="py-2 px-4 border-b border-grey-light text-right">{{$log->TRANSACTION.$log->MONTANTPAYEMENT}}💰</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    tr.hidden {
        display: none;
    }

    /* Transition pour les boutons */
    .expand-button {
        transition: background-color 0.3s, color 0.3s;
    }

    .expand-button:hover {
        background-color: #4a4a4a; /* Couleur de fond au survol */
        color: #ffffff; /* Couleur de texte au survol */
    }
</style>
    <!-- Script para las gráficas -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var expandButtons = document.querySelectorAll('.expand-button');

            expandButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = button.closest('tr').nextElementSibling;
                    row.classList.toggle('hidden');
                });
            });
        });


            document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du graphique des réservations
            var usersChart = new Chart(document.getElementById('usersChart'), {
            type: 'doughnut',
            data: {
            labels: ['Refusé', 'Clos', 'En cours'],
            datasets: [{
            data: [{{ $nbStatut4 }}, {{ $nbStatut3 }}, {{ $nbStatutReste }}],
            backgroundColor: ['#40a4dc', '#2881b0', '#1e6283'],
        }]
        },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
            position: 'bottom'
        }
        }
        });
        });

        // Gráfica de Comercios
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique des commerces
            var commercesChart = new Chart(document.getElementById('commercesChart'), {
                type: 'doughnut',
                data: {
                    labels: ['2 Derniers Jours', '7 Derniers Jours', 'Dernier Mois'],
                    datasets: [{
                        data: [{{ $nbReserv2 }}, {{ $nbReserv7 }}, {{ $nbReserv30 }}],
                        backgroundColor: ['#e5b312', '#c7a02a', '#9f8533'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });

        // Agregar lógica para mostrar/ocultar la navegación lateral al hacer clic en el ícono de menú
        const menuBtn = document.getElementById('menuBtn');
        const sideNav = document.getElementById('sideNav');

        menuBtn.addEventListener('click', () => {
            sideNav.classList.toggle('hidden'); // Agrega o quita la clase 'hidden' para mostrar u ocultar la navegación lateral
        });
    </script>
</x-app-layout>








