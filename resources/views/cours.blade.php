<x-app-layout>
    <div class="py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cours as $cour)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$cour['LIBELLEMATIERE']}}</div>
                    <p class="text-gray-700 text-base">
                        ID Matière: {{$cour['IDMATIERE']}}<br>
                        ID Spécialité: {{$cour['IDSPECIALITE']}}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <a href="#" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full">Voir détails</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
