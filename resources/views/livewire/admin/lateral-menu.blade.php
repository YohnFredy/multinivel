<div class="lateral-menu mt-6">
    <ul class="divide-y divide-palette-100 dark:divide-palette-30">

        <li>
            <x-lateral-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                <i class=" ml-5 mr-2 fas fa-building"></i>
                <span class="text">Inicio</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="{{ route('admin.category') }}" :active="request()->routeIs('admin.category')">
                <i class=" ml-5 mr-2 fas fa-layer-group"></i>
                <span class="text">Categoria</span>
            </x-lateral-nav-link>
        </li>
        <li>
            <x-lateral-nav-link href="{{ route('admin.subcategory') }}" :active="request()->routeIs('admin.subcategory')">
                <i class="ml-5 mr-2 fas fa-list"></i>
                <span class="text">Subcategory</span>
            </x-lateral-nav-link>
        </li>
        <li>
            <x-lateral-nav-link href="{{ route('admin.brand') }}" :active="request()->routeIs('admin.brand')">
                <i class="ml-5 mr-2 far fa-registered"></i>
                <span class="text">Marca</span>
            </x-lateral-nav-link>
        </li>
        <li>
            <x-lateral-nav-link href="{{ route('admin.product') }}" :active="request()->routeIs('admin.product')">
                <i class="ml-5 mr-2 fas fa-tags"></i>
                <span class="text">Productos</span>
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
