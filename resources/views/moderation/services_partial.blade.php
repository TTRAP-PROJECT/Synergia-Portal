@foreach ($services as $service)
    <div class="service">
        <h3>{{ $service->LIBELLESERVICE }}</h3>
        <p>Vendeur: {{ $service->vendeur->NOMUTILISATEUR }} {{ $service->vendeur->PRENOMUTILISATEUR }}</p>
        <p>Prix: {{ $service->prix }}💰</p>
        <!-- Ajoutez d'autres informations sur le service que vous souhaitez afficher -->
    </div>
@endforeach
