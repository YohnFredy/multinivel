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
    <link href="{{ asset('css/admin-template.css') }}" rel="stylesheet">
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

<body class="font-sans antialiased bg-palette-100 dark:bg-palette-80">

    {{-- lateral menu --}}
    <div id="sidebar"
        class="sidebar bg-gradient-to-r from-palette-150  to-palette-200 text-palette-100 dark:text-palette-20  
        dark:bg-gradient-to-r dark:from-palette-50 dark:via-palette-70 dark:to-palette-80">
        <div class="sidebar-header shadow-xl shadow-palette-160 dark:shadow-palette-80 h-14 flex items-center">
            <a href="{{ route('admin.index') }}" class="flex items-center text-xl">
                <i class="ml-5 mr-2 fas fa-building"></i>
                <span class="text"><strong>Multi</strong>nivel</span>
            </a>
        </div>
        @livewire('admin.lateral-menu')
    </div>

    {{-- header_bar --}}
    <div id="header_bar"
        class="header-bar bg-white shadow-lg shadow-palette-10  text-palette-800 dark:bg-palette-70 dark:text-palette-30 dark:shadow-none">
        <button id="sidebarToggleButton"
            class="text-xl text-palette-400 hover:text-palette-200 dark:text-palette-20 dark:hover:text-white"><i
                class="fas fa-bars"></i></button>
        @livewire('admin.header-bar')
    </div>

    <div id="main_content" class="main-content">
        <div class="inner-content px-6 pt-6 pb-10 ">
            {{ $slot }}
        </div>

        <footer class=" text-palette-100 py-16 bg-palette-300 dark:bg-palette-60 ">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Sobre Nosotros</h3>
                        <p class="text-sm leading-relaxed">Somos una empresa dedicada a brindar soluciones innovadoras y
                            de alta calidad en el sector tecnológico. Nuestra misión es mejorar la vida de las personas
                            a través de la tecnología.</p>
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
                        <p class="text-sm leading-relaxed"><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
                        <p class="text-sm leading-relaxed"><strong>Teléfono:</strong> (123) 456-7890</p>
                        <p class="text-sm leading-relaxed"><strong>Email:</strong> contacto@empresa.com</p>
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
                    &copy; 2024 Empresa Ficticia. Todos los derechos reservados.
                </div>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
    @stack('js')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleButton = document.getElementById('sidebarToggleButton');
            const mainContent = document.getElementById('main_content');
            const headerBar = document.getElementById('header_bar');

            let sidebarIsCollapsed = false;

            const toggleSidebar = () => {
                sidebarIsCollapsed = !sidebarIsCollapsed;
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('visible', sidebarIsCollapsed);
                } else {
                    sidebar.classList.toggle('collapsed', sidebarIsCollapsed);
                    mainContent.classList.toggle('collapsed', sidebarIsCollapsed);
                    headerBar.classList.toggle('collapsed', sidebarIsCollapsed);
                    handleHoverEvents(sidebarIsCollapsed);
                }
            };

            const handleHoverEvents = (shouldAdd) => {
                if (shouldAdd) {
                    sidebar.addEventListener('mouseover', expandSidebar);
                    sidebar.addEventListener('mouseout', collapseSidebar);
                } else {
                    sidebar.removeEventListener('mouseover', expandSidebar);
                    sidebar.removeEventListener('mouseout', collapseSidebar);
                }
            };

            const expandSidebar = () => {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('collapsed');
                headerBar.classList.remove('collapsed');
            };

            const collapseSidebar = () => {
                if (sidebarIsCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    headerBar.classList.add('collapsed');
                }
            };

            const handleClickOutside = (event) => {
                if (sidebarIsCollapsed && window.innerWidth <= 768 && !sidebar.contains(event.target) && !
                    sidebarToggleButton.contains(event.target)) {
                    sidebar.classList.remove('visible');
                    sidebarIsCollapsed = false;
                }
            };

            sidebarToggleButton.addEventListener('click', toggleSidebar);
            document.addEventListener('click', handleClickOutside);
        });
    </script>
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
