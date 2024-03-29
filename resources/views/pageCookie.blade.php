<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-row items-center">
                    <div class="mr-8 bg-gray-500 text-black rounded focus:outline-none mb-4 relative">
                        <div id="plusOne" class="text-2xl font-bold text-gray-400 hidden absolute top-0 left-0 mt-1 ml-1">+1🍪</div>
                        <button id="cookieButton" style="font-size: 250px;" class="px-4 py-2">🍪</button>
                    </div>
                    <div>

                        <div class="rounded border border-gray-400 px-3 py-1 flex items-center w-max">
                            <span class="text-l font-bold mr-2">Vous avez {{ auth()->user()->SOLDE }}</span>
                            <span class="text-sm">💰</span>
                        </div>
                        <br><br>


                        <h2 class="text-3xl font-semibold text-gray-400 mb-4">Nombre de cookies</h2>
                        <p id="cookieCount" class="text-2xl font-bold text-black mb-4">{{ $cookieCount }}🍪</p>
                        <form action="{{ route('tradeCookie') }}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_amount" id="transactionAmount" value="1000"> <!-- Par défaut, définir la valeur à 1000 -->

                            <button id="transactionButton1000" type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md shadow-sm">
                                <span id="transactionText1000" class="px-4 py-2">Echanger 1.000🍪</span>
                            </button><br><br>
                            <button id="transactionButton10000" type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md shadow-sm">
                                <span id="transactionText10000" class="px-4 py-2">Echanger 10.000🍪</span>
                            </button><br>
                            <br>


                            @if (session('success'))
                                <div class="alert alert-success bg-green-400 rounded font-bold">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('fail'))
                                <div class="alert alert-success bg-red-400 rounded font-bold">
                                    {{ session('fail') }}
                                </div>
                            @endif
                        </form>
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
            var transactionAmountInput = document.getElementById('transactionAmount');
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

            function updateTransactionText(amount) {
                transactionAmountInput.value = amount;
            }

            function resetTransactionText() {
                transactionAmountInput.value = '';
            }

            // Ajouter des gestionnaires d'événements pour le survol des boutons de transaction

            document.getElementById('transactionButton1000').addEventListener('mouseleave', resetTransactionText);

            document.getElementById('transactionButton1000').addEventListener('mouseover', function() {
                document.getElementById('transactionText1000').innerText = '1000🍪 ⮕ 1💰';
            });
            document.getElementById('transactionButton1000').addEventListener('mouseleave', function() {
                document.getElementById('transactionText1000').innerText = 'Echanger 1.000🍪';
            });

            document.getElementById('transactionButton10000').addEventListener('mouseleave', function() {
                document.getElementById('transactionText10000').innerText = 'Echanger 10.000🍪';
            });

            document.getElementById('transactionButton10000').addEventListener('mouseover', function() {
                document.getElementById('transactionText10000').innerText = '10000🍪 ⮕ 10💰';
            });


            document.getElementById('transactionButton10000').addEventListener('mouseleave', resetTransactionText);

            document.getElementById('transactionButton1000').addEventListener('click', function() {
                transactionAmountInput.value = '1000'; // Mise à jour de la valeur pour échanger 1000 cookies
            });

            document.getElementById('transactionButton10000').addEventListener('click', function() {
                transactionAmountInput.value = '10000'; // Mise à jour de la valeur pour échanger 10000 cookies
            });

            cookieButton.addEventListener('click', function() {
                // Afficher l'indication visuelle de +1
                plusOneDisplay.classList.remove('hidden');
                setTimeout(function() {
                    plusOneDisplay.classList.add('hidden');
                }, 500);
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
