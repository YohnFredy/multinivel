@props(['active'])

@php
$classes = ($active ?? false)
            ? 'py-3 flex items-center bg-palette-100 text-palette-800 font-bold text-lg dark:bg-palette-80 dark:text-white'
            : 'py-3 flex items-center hover:bg-palette-300 hover:text-white dark:hover:bg-palette-60 dark:hover:text-palette-10';
@endphp

<a {{ $attributes->merge(['class' => $classes ])}}>
    {{ $slot }}
</a>

