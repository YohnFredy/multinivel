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




    @stack('js')

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

    <style>
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #f3f4f6, #e5e7eb);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s ease-out;
        }

        #loader {
            width: 80px;
            height: 80px;
            border: 5px solid #f3f4f6;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loader-hidden {
            opacity: 0;
            pointer-events: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader-logo {
            position: absolute;
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .loader-text {
            position: absolute;
            bottom: 20%;
            font-size: 1.2rem;
            color: #4b5563;
            font-weight: 500;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <img src="{{ asset('storage\images\fornuvi-logo.png') }}" alt="Logo" class="loader-logo">
        <p class="loader-text">Cargando...</p>
    </div>

    <div class="min-h-screen bg-palette-100 dark:bg-palette-80">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class=" text-palette-300 dark:text-palette-20">
            {{ $slot }}
        </main>



        <footer class=" text-palette-100 py-16 bg-palette-300 dark:bg-palette-60 ">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Sobre Nosotros</h3>
                        <p class="text-sm leading-relaxed">Somos una empresa dedicada a brindar soluciones innovadoras y
                            de alta calidad en el sector de la salud. Nuestra misión es mejorar la vida de las personas.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition duration-300">Inicio</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Servicios</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Proyectos</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Contacto</h3>
                        {{-- <p class="text-sm leading-relaxed"><strong>Dirección:</strong> Calle 15, Ciudad, País</p> --}}
                        <p class="text-sm leading-relaxed"><strong>Teléfono:</strong> +57 3145207814</p>
                        <p class="text-sm leading-relaxed"><strong>Email:</strong> contacto@fornuvi.com</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Síguenos</h3>
                        <div class="flex space-x-4 text-palette-20">
                            <a href="#" class="  hover:text-white transition duration-300"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-palette-100 mt-12 pt-8 text-center text-sm">
                    &copy; 2024 Fornuvi. Todos los derechos reservados.
                </div>
            </div>
        </footer>
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

    @stack('script')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loaderWrapper = document.getElementById('loader-wrapper');

            // Ocultar el loader después de un breve retraso
            setTimeout(function() {
                loaderWrapper.classList.add('loader-hidden');
                loaderWrapper.addEventListener('transitionend', function() {
                    if (loaderWrapper.parentNode) {
                        loaderWrapper.parentNode.removeChild(loaderWrapper);
                    }
                });
            }, 1000); // Ajusta este valor según sea necesario
        });
    </script>

</body>

</html>
