<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-row items-center">
                    <div class="mr-8 bg-gray-500 text-white rounded focus:outline-none mb-4 relative">
                        <div id="plusOne" class="text-2xl font-bold text-green-500 hidden absolute top-0 left-0 mt-1 ml-1">+1🍪</div>
                        <button id="cookieButton" style="font-size: 250px;" class="px-4 py-2">🍪</button>
                    </div>
                    <div>
                        <h2 class="text-3xl font-semibold text-gray-400 mb-4">Nombre de cookies</h2>
                        <p id="cookieCount" class="text-2xl font-bold text-black mb-4">{{ $cookieCount }}🍪</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var cookieButton = document.getElementById('cookieButton');
            var cookieCountDisplay = document.getElementById('cookieCount');
            var plusOneDisplay = document.getElementById('plusOne');
            var localCookieCount = parseInt(cookieCountDisplay.innerText);
            var accumulatedCookies = 0; // Nouvelle variable pour accumuler les clics localement
            var timeoutId; // Variable pour stocker l'ID du timeout

            function sendRequestToServer() {
                fetch('{{ route('addCookie') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({_token: '{{ csrf_token() }}', count: accumulatedCookies})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            localCookieCount += accumulatedCookies;
                            cookieCountDisplay.innerText = localCookieCount + '🍪';
                            accumulatedCookies = 0; // Réinitialiser le nombre de clics accumulés
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function resetTimeout() {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(sendRequestToServer, 2000); // Envoyer après 2 secondes d'inactivité
            }

            cookieButton.addEventListener('click', function() {
                // Ajouter un cookie localement
                accumulatedCookies++;
                // Mettre à jour l'affichage du nombre de cookies localement
                cookieCountDisplay.innerText = localCookieCount + accumulatedCookies + '🍪';
                // Réinitialiser le délai de l'envoi
                resetTimeout();
                // Si le nombre de cookies accumulés atteint 50, envoyer immédiatement
                if (accumulatedCookies >= 50) {
                    clearTimeout(timeoutId);
                    sendRequestToServer();
                }
            });

            // Initialiser le délai pour envoyer après 2 secondes d'inactivité
            resetTimeout();
        });
    </script>
</x-app-layout>
