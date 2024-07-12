<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
    <title>Menu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            transition: width 0.3s, left 0.3s;
            z-index: 10;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar a {
            display: flex;
            white-space: nowrap;
        }

        .sidebar .text {
            transition: opacity 0.3s, visibility 0.3s;
            visibility: visible;
            opacity: 1;
        }

        .sidebar.collapsed .text {
            visibility: hidden;
            opacity: 0;
        }

        .sidebar-header {
            flex-shrink: 0;
        }

        .lateral-menu {
            flex-grow: 1;
            overflow-y: auto;
            margin-top: 0;
        }

        .lateral-menu::-webkit-scrollbar {
            width: 8px;
        }

        .lateral-menu::-webkit-scrollbar-track {
            background: #4a5568;
        }

        .lateral-menu::-webkit-scrollbar-thumb {
            background-color: #718096;
            border-radius: 4px;
            border: 2px solid #4a5568;
        }

        .lateral-menu::-webkit-scrollbar-thumb:hover {
            background-color: #a0aec0;
        }

        .header-bar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 56px;
            background-color: #ffffff;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0 1rem;
            transition: left 0.3s;
        }

        .header-bar.collapsed {
            left: 60px;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 56px;
            transition: margin-left 0.3s;
            overflow-y: auto;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .main-content.collapsed {
            margin-left: 60px;
        }

        .main-content>.inner-content {
            padding: 1rem;
            flex-grow: 1;
        }

        footer {
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                left: -250px;
                z-index: 20;
            }

            .sidebar.visible {
                left: 0;
            }

            .header-bar {
                left: 0;
                transition: left 0.3s;
            }

            .header-bar.collapsed {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding-top: 56px;
                overflow-y: auto;
                height: calc(100vh - 56px);
            }

            .main-content.collapsed {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-100 ">
    <div id="sidebar" class="sidebar bg-gray-700 text-gray-300 shadow-2xl shadow-gray-500">
        <div class="sidebar-header shadow-xl shadow-gray-500 h-14 flex items-center">
            <a href="#" class="flex items-center text-xl">
                <i class="ml-5 mr-2 fas fa-building"></i>
                <span class="text"><strong>Multi</strong>nivel</span></a>
        </div>

        <div class="lateral-menu mt-4">
            <ul class="divide-y">
                <li class="py-2 hover:bg-gray-800">
                    <a href="http://multinivel.test/menu" class="flex items-center">
                        <i class="ml-5 mr-2 fas fa-building"></i>
                        <span class="text">Inicio</span></a>
                </li>
                <li class="py-2 hover:bg-gray-800">
                    <a href="{{ route('tree.binary') }}" class="flex items-center">
                        <i class="ml-6 mr-2 fas fa-project-diagram"></i>
                        <span class="text">Binario</span>
                    </a>
                </li>
                <li class="py-2 hover:bg-gray-800">
                    <a href="{{ route('tree.binary') }}" class="flex items-center">
                        <i class="ml-6 mr-2 fas fa-project-diagram"></i>
                        <span class="text">Binario</span>
                    </a>
                </li>
                <!-- Agrega más elementos aquí -->
            </ul>
        </div>
    </div>

    <div id="header_bar" class="header-bar text-gray-600">
        <button id="sidebarToggleButton" class="text-xl hover:text-gray-900"><i class="fas fa-bars"></i></button>

        <div class="">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent hover:text-gray-900 text-sm leading-4 font-medium rounded-md  dark:text-gray-400 bg-white dark:bg-gray-800 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                    {{ $user = Auth::user()->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-500">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <div id="main_content" class="main-content">
        <div class="inner-content text-gray-600">
            @livewire('admin.tree.unilevel')
        </div>
        <footer class=" text-gray-300 py-16" style="background-color: rgb(55 65 78)">
            <div class="container mx-auto px-6 lg:px-8">
              <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                  <h3 class="text-xl font-semibold text-white mb-4">Sobre Nosotros</h3>
                  <p class="text-sm leading-relaxed">Somos una empresa dedicada a brindar soluciones innovadoras y de alta calidad en el sector tecnológico. Nuestra misión es mejorar la vida de las personas a través de la tecnología.</p>
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
                  <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                  </div>
                </div>
              </div>
              <div class="border-t border-gray-700 mt-12 pt-8 text-center text-sm">
                &copy; 2024 Empresa Ficticia. Todos los derechos reservados.
              </div>
            </div>
          </footer>
          

    </div>

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
</body>

</html>
