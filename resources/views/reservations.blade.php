<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold mb-6">Liste de vos réservations</h1>
                <ul class="divide-y divide-gray-200">
                    @foreach($reservations as $reservation)
                        <li class="py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="font-bold text-lg text-blue-600 cursor-pointer" onclick="toggleAdditionalInfo(this)" data-vendeur="{{ $reservation->service->IDVENDEUR }}" data-max="{{ $reservation->service->NBPERSONNESMAX }}">{{ $reservation->service->LIBELLESERVICE }}</div>
                                    <div class="text-gray-500">{{ $reservation->DATETRANSACTION }}</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-4 text-lg">{{ $reservation->service->prix }}💰</div>
                                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Annuler</button>
                                </div>
                            </div>
                            <div class="additional-info overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 0;">
                                <p class="text-gray-700 font-bold">Vendeur: {{ $reservation->service->vendeur->NOMUTILISATEUR." ".$reservation->service->vendeur->PRENOMUTILISATEUR }}</p>
                                <p class="text-gray-700 font-bold">{{ $reservationCounts[$reservation->service->IDSERVICE] }}/{{ $reservation->service->NBPERSONNESMAX }}👤</p>

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleAdditionalInfo(label) {
        var infoDiv = label.parentElement.parentElement.nextElementSibling;
        if (infoDiv.style.maxHeight === "0px") {
            infoDiv.style.maxHeight = infoDiv.scrollHeight + "px";
        } else {
            infoDiv.style.maxHeight = "0px";
        }
    }
</script>
