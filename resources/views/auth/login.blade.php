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
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <div class="ml-16 ">
                            <a href="/">
                                <x-application-logo class="w-2 h-2 fill-current text-gray-500" />
                            </a>
                        </div>
                        <h1 class="text-2xl font-semibold">Connectez-vous !</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="relative mb-5">
                                    <input autocomplete="on" id="email" name="emailutilisateur" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-600 rounded" placeholder="Adresse mail" />
                                    <label for="email" class="absolute left-0 -top-2 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Adresse mail</label>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="relative">
                                    <input autocomplete="on" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-600 rounded" placeholder="Mots de passe" />
                                    <label for="password" class="absolute left-0 -top-2 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Mots de passe</label>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 " />
                                </div>
                                <br>
                                <div class="block mt-0 relative z-0"> <!-- Utilisez la classe relative et z-0 pour la grande div -->
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 opacity-60" name="remember">
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                                    </label>
                                </div>
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
</x-guest-layout>
