@props(['label' => '', 'for' => '', 'disabled' => false])

<x-label for="{{ $for }}">{{ $label }}</x-label>

<div class="w-full max-w-xs ">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' => ' mt-1 file:bg-palette-200 dark:file:bg-palette-80 file:hover:bg-palette-150 dark:file:hover:bg-palette-70 file:text-palette-100 dark:file:text-palette-30  file:hover:text-white file:border-none file:text-sm file:px-4 file:py-2 rounded-lg file:cursor-pointer cursor-pointer bg-palette-100 dark:bg-palette-40 text-palette-300 dark:text-palette-30 text-xs pr-4 focus:outline-none',
    ]) !!} type="file" />
</div>

<x-input-error for="{{ $for }}.*" />
