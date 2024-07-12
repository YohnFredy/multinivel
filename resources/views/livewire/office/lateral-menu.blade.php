<div class="lateral-menu mt-6">
    <ul class="divide-y divide-palette-100 dark:divide-palette-30">

       <li>
            <x-lateral-nav-link href="{{ route('office.index') }}" :active="request()->routeIs('office.index')">
                <i class=" ml-5 mr-2 fas fa-building"></i>
                <span class="text">Inicio</span>
            </x-lateral-nav-link>
        </li> 

        <li>
            <x-lateral-nav-link href="{{ route('index') }}">
                <i class="ml-5 mr-2 fas fa-store"></i>
                <span class="text">Tienda</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="{{ route('tree.binary') }}" :active="request()->routeIs('tree.binary')">
               {{--  <i class="ml-5 mr-2 fas fas fa-network-wired"></i> --}}
                <i class="ml-5 mr-2 fas fa-project-diagram"></i>
                <span class="text">Binario</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="{{ route('tree.unilevel') }}" :active="request()->routeIs('tree.unilevel')">
                <i class="ml-5 mr-2 fas fa-sitemap"></i>
                <span class="text">unilevel</span>
            </x-lateral-nav-link>
        </li>

        <!-- Agrega más elementos aquí -->
    </ul>
</div>

