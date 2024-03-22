<x-app-layout>
    <div class="form">
        <form action="{{ route('services') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="idService" class="sr-only">ID Service</label>
                <input type="text" name="idService" id="idService" placeholder="ID Service" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('idService') }}">
            </div>
            <div class="mb-4">
                <label for="libelleService" class="sr-only">Libellé Service</label>
                <input type="text" name="libelleService" id="libelleService" placeholder="Libellé Service" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('libelleService') }}">
            </div>
            <div class="mb-4">
                <label for="idCategorie" class="sr-only">ID Catégorie</label>
                <input type="text" name="idCategorie" id="idCategorie" placeholder="ID Catégorie" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('idCategorie') }}">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Ajouter Service</button>
            </div>
        </form>
    </div>
    <div class="py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$service['LIBELLESERVICE']}}</div>
                    <p class="text-gray-700 text-base">
                        ID Service: {{$service['IDSERVICE']}}<br>
                        ID Catégorie: {{$service['IDCATEGORIE']}}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <a href="#" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full">Voir détails</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
