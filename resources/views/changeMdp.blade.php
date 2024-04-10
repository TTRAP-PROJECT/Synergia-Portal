{{--<x-guest-layout class="relative">--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}
{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}
{{--                <!-- Email Address -->--}}
{{--                <div class="relative z-0"> <!-- Utilisez la classe relative et z-0 pour la grande div -->--}}
{{--                    <x-input-label for="email" :value="__('Email')" />--}}
{{--                    <x-text-input-login id="email" class="block mt-1 w-full" type="email" name="emailutilisateur" :value="old('emailutilisateur')" required autofocus autocomplete="username" />--}}
{{--                    <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--                </div>--}}

{{--                <!-- Password -->--}}
{{--                <div class="mt-4 relative z-0"> <!-- Utilisez la classe relative et z-0 pour la grande div -->--}}
{{--                    <x-input-label for="password" :value="__('Password')" />--}}

{{--                    <x-text-input-login id="password" class="block mt-1 w-full"--}}
{{--                                  type="password"--}}
{{--                                  name="password"--}}
{{--                                  required autocomplete="current-password" />--}}

{{--                    <x-input-error :messages="$errors->get('password')" class="mt-2 " />--}}
{{--                </div>--}}

{{--                <!-- Remember Me -->--}}
{{--                <div class="block mt-4 relative z-0"> <!-- Utilisez la classe relative et z-0 pour la grande div -->--}}
{{--                    <label for="remember_me" class="inline-flex items-center">--}}
{{--                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 opacity-60" name="remember">--}}
{{--                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--                    </label>--}}
{{--                </div>--}}

{{--                <div class="flex items-center justify-end mt-4 relative z-0"> <!-- Utilisez la classe relative et z-0 pour la grande div -->--}}
{{--                    @if (Route::has('password.request'))--}}
{{--                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                            {{ __('Forgot your password?') }}--}}
{{--                        </a>--}}
{{--                    @endif--}}

{{--                    <x-login-register-button class="ms-3">--}}
{{--                        {{ __('Connexion') }}--}}
{{--                    </x-login-register-button>--}}
{{--                </div>--}}
{{--        </form>--}}

{{--</x-guest-layout>--}}
<x-guest-layout>
    <div class="flex flex-row w-3/4">
        <div class=" h-min p-0 m-10 dark:bg-gray-800 sm:rounded-3xl">
            <div class="flex flex-col justify-center">
                <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                    <div
                        class=" m-10 absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                    <div class="relative p-3 m-6 bg-white shadow-lg sm:rounded-3xl">
                        <p class="text-blue-500 mb-6">Votre mot de passe doit correspondre à nos règles de sécurité,<br>
                            il
                            doit
                            être composé de :</p>
                        <ul class="list-disc mb-6 pl-6 space-y-2">
                            <li id="lenght" class="text-red-600">Minimum 8 caractères</li>
                            <li id="A-Z" class="text-red-600">Minimum 1 lettre majuscule</li>
                            <li id="a-z" class="text-red-600">Minimum 1 lettre minuscule</li>
                            <li id="0-9" class="text-red-600">Minimum 1 chiffre</li>
                            <li id="!!" class="text-red-600">Minimum 1 caractère spécial</li>
                        </ul>
                        @if(session('error') !== null)
                            @if(session('error')==true)
                                <div
                                    class="alert bg-red-500 rounded font-bold alert-danger text-center py-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 dark:bg-gray-800 sm:rounded-lg">
            <div class="py-6 flex flex-col justify-center sm:py-12">
                <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                    <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                        <div class="max-w-md mx-auto">
                            <div>
                                <div class="ml-16 ">
                                    <a href="/">
                                        <x-application-logo class="w-2 h-2 fill-current text-gray-500"/>
                                    </a>
                                </div>
                                <h1 class="text-2xl font-semibold">Veuillez indiquer votre nouveau mot de passe</h1>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                    <form method="POST" action="{{ route('nouveauMdp') }}">
                                        @csrf
                                        <div class="relative mb-5">
                                            <input autocomplete="on" id="password" name="password" type="password"
                                                   class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-600 rounded"
                                                   placeholder="Votre nouveau mot de passe"/>
                                            <label for="password"
                                                   class="ml-2 absolute left-0 -top-2 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Mot
                                                de passe</label>
                                        </div>
                                        <div class="relative">
                                            <input autocomplete="on" id="repassword" name="repassword" type="password"
                                                   class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-600 rounded"
                                                   placeholder="Retapez votre mot de passe"/>
                                            <label for="repassword"
                                                   class="ml-2 absolute left-0 -top-2 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Retapez
                                                votre mot de passe</label>
                                        </div>
                                        <br>
                                        <x-login-register-button class="ms-8">
                                            {{ __('Connexion') }}
                                        </x-login-register-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // on idique l'input du mot de passe
                var password = document.getElementById("password")
                // on indique les li de la liste des règles
                var lenght = document.getElementById("lenght")
                var A_Z = document.getElementById("A-Z")
                var a_z = document.getElementById("a-z")
                var zero_nine = document.getElementById("0-9")
                var special = document.getElementById("!!")

                // on indique les regex
                var regex_lenght = new RegExp("^(?=.{8,})")
                var regex_A_Z = new RegExp("^(?=.*?[A-Z])")
                var regex_a_z = new RegExp("^(?=.*?[a-z])")
                var regex_zero_nine = new RegExp("^(?=.*?[0-9])")
                var regex_special = new RegExp("^(?=.*?[#?!@$%^&*-])")

                // on indique les fonctions
                function check_lenght() {
                    // si le mot de passe est supérieur ou égal à 8 caractères on met la li en vert
                    if (regex_lenght.test(password.value)) {
                        lenght.style.color = 'green'
                    } else {
                        lenght.style.color = 'red'
                    }
                }

                function check_A_Z() {
                    if (regex_A_Z.test(password.value)) {
                        A_Z.style.color = 'green'
                    } else {
                        A_Z.style.color = 'red'
                    }
                }

                function check_a_z() {
                    if (regex_a_z.test(password.value)) {
                        a_z.style.color = 'green'
                    } else {
                        a_z.style.color = 'red'
                    }
                }

                function check_zero_nine() {
                    if (regex_zero_nine.test(password.value)) {
                        zero_nine.style.color = 'green'
                    } else {
                        zero_nine.style.color = 'red'
                    }
                }

                function check_special() {
                    if (regex_special.test(password.value)) {
                        special.style.color = 'green'
                    } else {
                        special.style.color = 'red'
                    }
                }

                // on ajoute les écouteurs d'évènements
                password.addEventListener("keyup", check_lenght)
                password.addEventListener("keyup", check_A_Z)
                password.addEventListener("keyup", check_a_z)
                password.addEventListener("keyup", check_zero_nine)
                password.addEventListener("keyup", check_special)


            </script>
        </div>
    </div>
</x-guest-layout>
