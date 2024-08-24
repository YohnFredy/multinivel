@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 border-b-2 border-palette-400 text-sm font-medium leading-5 text-palette-300 focus:outline-none focus:border-palette-200 dark:border-white dark:text-white dark:focus:border-palette-30 transition duration-150 ease-in-out'

            : 'inline-flex items-center pr-1 border-b-2 border-transparent text-sm font-medium leading-5 text-palette-200 hover:text-palette-300 hover:border-palette-300 focus:outline-none focus:text-palette-300 focus:border-palette-200 

            dark:text-palette-30 dark:hover:text-white dark:hover:border-white dark:focus:text-white dark:focus:border-palette-30 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
