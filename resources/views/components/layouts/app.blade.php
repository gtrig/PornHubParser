<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? 'Page Title' }}</title>
        <link
            rel="shortcut icon"
            href="assets/images/favicon.png"
            type="image/x-icon"
        />
        @stack('styles')
        <link rel="stylesheet" href="{{ Vite::asset("resources/css/swiper-bundle.min.css") }}" />
        <link rel="stylesheet" href="{{ Vite::asset("resources/css/animate.css") }}" />

        <script src="{{ Vite::asset("resources/js/wow.min.js")}}"></script>
        <script>
            new WOW().init();
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"
        />
        @vite(['resources/css/app.css', 'resources/js/app.js'])        
        @livewireStyles
        
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen dark:bg-dark">
            {{ $slot }}
        </div>
        @stack('scripts')
        @livewireScripts
    </body>
</html>