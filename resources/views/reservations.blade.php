<x-app-layout>
    <!-- component -->

    <div class="flex flex-row">

        <section class="bg-white py-24 px-4 lg:px-16">

            <div class="container mx-auto px-[12px] md:px-24 xl:px-12 max-w-[1300px] nanum2 ">
                <h1 class="text-3xl font-bold mb-10">Liste de vos réservations</h1>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-4 gap-y-28 lg:gap-y-16">

                    @foreach($reservations as $reservation)
                        <div  data-reservation-id="{{ $reservation->IDRESERVATION }}" id="reservation" class="relative group h-48 flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div class="h-28">
                                <div class="absolute -top-20 lg:top-[-10%] left-[5%] z-40 group-hover:top-[-60%] group-hover:opacity-[0.9] duration-300 w-[90%] h-48 bg-gradient-to-br from-orange-200 to-cyan-200 rounded-xl justify-items-center align-middle">
                                    @if($reservation->service->typeService==1)
                                        <img src="/images/des-sports.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                                    @elseif($reservation->service->typeService==2)
                                        <img src="/images/cinema.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                                    @elseif($reservation->service->typeService==4)
                                        <img src="/images/covoiturage2.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                                    @elseif($reservation->service->typeService==5)
                                        <img src="/images/loisirs.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                                    @elseif($reservation->service->typeService==7)
                                        <img src="/images/competence.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('annulerReservation') }}" method="POST" id="form-{{ $reservation->IDRESERVATION }}">
                                @csrf
                                <input type="hidden" value="{{ $reservation->IDRESERVATION }}" name="idService"/>
                                <div class="p-6 z-10 w-full flex flex-row">
                                    <p class="mb-2 inline-block text-tg text-center w-full text-xl font-sans font-semibold leading-snug tracking-normal antialiased">
                                        {{ $reservation->service->LIBELLESERVICE }}<br>
                                    </p>
                                    <button onclick="confirmDelete(event, '{{ $reservation->IDRESERVATION }}')">
                                        <img src="/images/effacer.png" class="w-10 h-10"/>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>
        <div id="maDiv" class=" mt-5 right-0">
            Cliquer sur votre réservation pour en afficher les détails !
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(event, reservationId) {
        event.preventDefault();
        var result = confirm("Êtes-vous sûr de vouloir annuler cette réservation ?");
        if (result) {
            // Submit the form
            document.getElementById('form-' + reservationId).submit();
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Get all reservation elements
        var reservations = document.querySelectorAll("[data-reservation-id]");

        // Add click event listener to each reservation
        reservations.forEach(function(reservation) {
            reservation.addEventListener("click", function() {
                // Get the reservation ID
                var reservationId = this.dataset.reservationId;

                // Fetch reservation information dynamically
                fetch('informationReservation/' + reservationId)
                    .then(result => result.text())
                    .then(data => {
                        // Populate maDiv with the fetched data
                        document.getElementById("maDiv").innerHTML = data;
                    });
            });
        });
    });
</script>
