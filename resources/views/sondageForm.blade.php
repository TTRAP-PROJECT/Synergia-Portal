<x-app-layout>
    <div class="bg-gradient-to-tr from-slate-300 to-zinc-300">
        <section id="login" class="p-2 flex flex-col justify-center  max-w-md mx-auto">
            <div class="p-6 bg-gray-100 rounded">
                <div class="flex items-center justify-between font-black m-3 mb-12">


                    <h1 class="tracking-wide text-3xl text-gray-900">Créer un sondage</h1>

                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="40px" height="40px" viewBox="0 0 459 459" style="enable-background:new 0 0 459 459;" xml:space="preserve"><g><g id="poll"><path d="M408,0H51C22.95,0,0,22.95,0,51v357c0,28.05,22.95,51,51,51h357c28.05,0,51-22.95,51-51V51C459,22.95,436.05,0,408,0zM153,357h-51V178.5h51V357z M255,357h-51V102h51V357z M357,357h-51V255h51V357z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
</svg>
                </div>

                <form id="login_form" action="{{ route('create-sondageBDD')}}" method="POST"
                      class="flex flex-col justify-center">
                    @csrf
                    <div class="flex justify-between items-center mb-3">
                        <div class="inline-flex items-center self-start">

                            <span class="font-bold text-gray-900">Disponibilité ( en jours )</span>
                        </div>
                        <div class="flex">
                            <button type="button" onclick="minus()" class="bg-gray-400 p-1.5 font-bold rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <input name="number" id="item_count" type="number" value="1" class="max-w-[100px] font-bold font-mono py-1.5 px-2 mx-1.5
                                block border border-gray-300 rounded-md text-sm shadow-sm  placeholder-gray-400
                                focus:outline-none
                                focus:border-sky-500
                                focus:ring-1
                                focus:ring-sky-500
                                focus:invalid:border-red-500  focus:invalid:ring-red-500">

                            <button type="button" onclick="plus()" class="bg-gray-400 p-1.5 font-bold rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <label class="text-sm font-medium">Sujet du sondage :</label>
                    <input class="mb-3 px-2 py-1.5
                          mb-3 mt-1 block w-full px-2 py-1.5 border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                          focus:outline-none
                          focus:border-sky-500
                          focus:ring-1
                          focus:ring-sky-500
                          focus:invalid:border-red-500 focus:invalid:ring-red-500" type="text" name="nomSondage" placeholder="L'oeuf est il arrivé avant la poule ?">

                    <button class="px-4 py-1.5 rounded-md shadow-lg bg-gray-500 font-medium text-gray-100 block transition duration-300" type="submit">
                        <span id="login_process_state" class="hidden">Envoi</span>
                        <span id="login_default_state">Partager le sondages pendant : <span id="subtotal">1</span> jour(s)</span>
                    </button>
                </form>
            </div>
        </section>

        <script>
            // document.getElementById("login_form").onsubmit = function() {
            //     event.preventDefault()
            //     // animation
            //     document.getElementById("login_process_state").classList.remove("hidden")
            //     document.getElementById("login_process_state").classList.add("animate-pulse")
            //
            //     document.getElementById("login_default_state").classList.add("hidden")
            // }

            let current_count = parseInt(document.getElementById("item_count").value)
            let subtotal = parseInt(1)

            function plus() {
                document.getElementById("item_count").value = ++current_count
                document.getElementById("subtotal").innerHTML =` ${subtotal * document.getElementById("item_count").value}`

            }

            function minus() {
                if(current_count < 2) {
                    current_count = 1
                    document.getElementById("item_count").value = 1
                    document.getElementById("subtotal").innerHTML =` ${subtotal * document.getElementById("item_count").value}`
                } else {
                    document.getElementById("item_count").value = --current_count
                    document.getElementById("subtotal").innerHTML =` ${subtotal * document.getElementById("item_count").value}`
                }
            }

        </script>
    </div>
</x-app-layout>
