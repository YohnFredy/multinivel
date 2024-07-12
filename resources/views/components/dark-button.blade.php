<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-dropdown-button>
            <span x-show="!isDarkMode" class="mr-2"><i class="fas fa-moon"></i></span>
            <span x-show="isDarkMode" class="mr-2"><i class="fas fa-sun"></i></span>
            <span>Modo</span>
        </x-dropdown-button>
    </x-slot>
    <x-slot name="content">
        <!-- Account Management -->
        <ul class=" mx-2 divide-y divide-palette-200  dark:divide-palette-30 ">
            <div class="block px-4 pt-2 pb-4 text-palette-400 text-xs dark:text-palette-10">
                Elige tu modo
            </div>
            <x-dropdown-link @click.prevent="mode = 'light'; open = false" href="#">
                <strong class="fas fa-sun"> </strong>
                Claro
            </x-dropdown-link>
            <x-dropdown-link @click.prevent="mode = 'dark'; open = false" href="#">
                <span class=""> <i class=" fas fa-moon"></i></span> Oscuro
            </x-dropdown-link>
            <x-dropdown-link @click.prevent="mode = 'system'; open = false" href="#">
                <i class=" fas fa-desktop"> </i> Sistema
            </x-dropdown-link>
        </ul>
    </x-slot>
</x-dropdown>
