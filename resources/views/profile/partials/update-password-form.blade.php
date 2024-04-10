<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Mise à jour du mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Cliquez sur le bouton ci-dessous pour modifier votre mot de passe') }} <br>
            {{ __('Veillez à utiliser un mot de passe sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Modifier mon mot de passe') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Mot de passe mis à jour.') }}</p>
            @endif
        </div>
    </form>
</section>
