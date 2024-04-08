<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gradient-to-tr from-slate-300 to-zinc-300 dark:bg-white-900" id="dynamic-bg">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white dark:bg-white-800 shadow">
        <div class="flex justify-around py-6"> <!-- Ajout de l'espace en haut et en bas -->

            <a href="{{ route('services') }}" class="text-blue-900 font-bold text-xl">Services</a>
            <a href="{{ route('espace_pro') }}" class="text-blue-900 font-bold text-xl">Espace Pro</a>
            <a href="{{ route('getReservations') }}" class="text-blue-900 font-bold text-xl">Reservations</a>
            <a href="{{ route('pageCookie') }}" class="text-blue-900 font-bold text-xl">Espace Cookie</a>
        </div>
    </header>


    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

<script>
    // JavaScript code for dynamic background gradient
    function updateBackground() {
        var colors = ["#slate-300", "#zinc-300", "#white-900"]; // List of colors to cycle through
        var currentIndex = 0; // Current index of the color array
        var interval = 5000; // Interval in milliseconds

        setInterval(function() {
            // Update the background gradient colors
            document.getElementById("dynamic-bg").style.background = "linear-gradient(to top right, " + colors[currentIndex] + ")";
            currentIndex = (currentIndex + 1) % colors.length; // Increment index and loop back to the beginning if necessary
        }, interval);
    }

    // Call the function to start updating the background gradient
    updateBackground();
</script>
</body>


</html>
