<div class="lateral-menu mt-6">
    <ul class="divide-y divide-palette-100 dark:divide-palette-30">

       <li>
            <x-lateral-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
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

        <!-- Agrega más elementos aquí -->
    </ul>
</div>
