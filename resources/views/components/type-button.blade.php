@props(['type' => 'button'])
<button
    {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 bg-palette-200 dark:bg-palette-80 border border-transparent rounded-md font-semibold text-xs text-white dark:text-palette-30 uppercase tracking-widest hover:bg-palette-150 dark:hover:bg-palette-50 focus:bg-palette-150 dark:focus:bg-palette-70 active:bg-palette-150 dark:active:bg-palette-70 focus:outline-none focus:ring-2 focus:ring-palette-200 dark:focus:ring-palette-50  focus:ring-offset-2 dark:focus:ring-offset-palette-30 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>