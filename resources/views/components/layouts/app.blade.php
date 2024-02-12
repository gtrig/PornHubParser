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
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        
    </head>
    <body class="font-sans antialiased bg-gray-100 dark">
        <div class="min-h-screen dark:bg-black dark:text-slate-100">
            {{ $slot }}
        </div>
        @stack('scripts')
        @livewireScripts
    </body>
</html>