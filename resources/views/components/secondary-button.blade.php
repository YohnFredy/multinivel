<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-palette-100 dark:bg-palette-40 border border-palette-200 dark:border-0 hover:border-palette-300 rounded-md font-semibold text-xs text-palette-300 hover:text-palette-200 dark:text-palette-30 uppercase tracking-widest hover:bg-white dark:hover:bg-palette-70 focus:outline-none  disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

