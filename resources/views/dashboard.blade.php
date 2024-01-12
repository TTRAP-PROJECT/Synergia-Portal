<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
                    {{ __('Cours') }}
                </h2>
                <h2 class="ml-20 font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
                    {{ __('Convoiturage') }}
                </h2>
                <h2 class="ml-20 font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
                    {{ __('Evènement') }}
                </h2>
                <h2 class="ml-20 font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
                    {{ __('Espace Pro') }}
                </h2>
            </div>

            <form>
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                </div>
            </form>



        </div>
    </x-slot>

    <div class="py-12 flex">
        <div class="flex-col">
            <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Sondafzeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeege") }}
                    </div>
                </div>
            </div>
                    <br>
            <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Annonce") }}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Events") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
