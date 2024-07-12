<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 mb-1 text-start text-sm leading-5 text-palette-300 hover:text-palette-100 rounded-lg
            hover:bg-gradient-to-r from-palette-200 dark:from-black to-palette-150 
            dark:to-palette-60 dark:text-palette-10 dark:hover:text-white transition duration-150 ease-in-out',
    ]) }}>{{ $slot }}
</a>
