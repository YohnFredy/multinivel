<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="darkModeHandler()" x-init="init()"
    x-bind:class="{ 'dark': isDarkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    @stack('css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const darkMode = localStorage.getItem('dark');
            if (darkMode === 'true' || (darkMode === null && window.matchMedia('(prefers-color-scheme: dark)')
                .matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-palette-100 dark:bg-palette-80">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class=" text-palette-300 dark:text-palette-20">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    
    <script>
        function darkModeHandler() {
            return {
                isDarkMode: localStorage.getItem('dark') === 'true' || (localStorage.getItem('dark') === null && window
                    .matchMedia('(prefers-color-scheme: dark)').matches),
                mode: localStorage.getItem('mode') || 'system',
                open: false,
                init() {
                    this.$watch('isDarkMode', value => localStorage.setItem('dark', value));
                    this.$watch('mode', value => {
                        localStorage.setItem('mode', value);
                        if (value === 'dark') {
                            this.isDarkMode = true;
                        } else if (value === 'light') {
                            this.isDarkMode = false;
                        } else {
                            this.isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        }
                    });

                    if (this.mode === 'system') {
                        this.isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        if (this.mode === 'system') {
                            this.isDarkMode = e.matches;
                        }
                    });
                },
                setMode(mode) {
                    this.mode = mode;
                }
            }
        }
    </script>

</body>

</html>
