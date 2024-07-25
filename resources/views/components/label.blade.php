@props(['value'])

<label {{ $attributes->merge(['class' => 'font-medium text-sm text-palette-200 dark:text-palette-10']) }}>
    {{ $value ?? $slot }}
</label>
