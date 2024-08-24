<nav x-data="{ open: false }" class="bg-white dark:bg-palette-50 border-b border-palette-30 dark:border-palette-70">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                        Inicio
                    </x-nav-link>
                    <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">
                        {{'Productos' }}
                    </x-nav-link>
                    <x-nav-link href="#">
                        {{ 'Oportunidad' }}
                    </x-nav-link>
                    <x-nav-link href="#">
                        {{ 'Contacto' }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('office.index') }}" :active="request()->routeIs('office.index')">
                        {{ 'Oficina' }}
                    </x-nav-link>
                </div>

                {{-- <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('membership', ['username' => 'master','position'=> 'right']) }}" :active="request()->routeIs('membership')">
                        {{ __('membership') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- <div class="hidden lg:flex mr-2" x-cloak>
                    <x-dark-button />
                </div> --}}
                
                <!-- Teams Dropdown -->
                @auth
                    <x-profile-configuration />
                @else
                    <a href="{{ route('login') }}" :active="request() -> routeIs('login')">
                        <x-dropdown-button>
                            Iniciar Sesión
                        </x-dropdown-button>
                    </a>
                @endauth

                <!-- cart -->
                <div class=" ml-3">
                    <a href="{{ route('cart') }}" :active="request()->routeIs('cart')" class="relative inline-block cursor-pointer">
                        <i class="fas fa-cart-arrow-down text-xl {{ request()->routeIs('cart') ? 'text-palette-400' : 'text-palette-200 hover:text-palette-300' }}"></i>
                        <div class="top-0 left-5 absolute {{ request()->routeIs('cart') ? 'bg-palette-200' : 'bg-palette-400' }} rounded-full p-1"></div> 
                    </a>
                </div>
                
               
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <x-dark-button />
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            @if (Route::has('login'))
                @auth
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                    </div>
                @else
                    <div class="flex items-center px-4 mb-4">
                        <!-- Authentication -->
                        <a href="{{ route('login') }}" :active="request() - > routeIs('login')">
                            Iniciar Sesión
                        </a>
                    </div>
                @endauth
            @endif

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
