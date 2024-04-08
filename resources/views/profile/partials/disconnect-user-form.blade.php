<form method="post" action="{{ route('logout') }}" class="p-6">
    @csrf
    @method('post')

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Etes-vous sur de vouloir vous déconnecter ?') }}
    </h2>

        <x-danger-button class="ms-3">
            {{ __('Se déconnecter') }}
        </x-danger-button>
</form>
