@props(['label' => '', 'for'=> '', 'disabled' => false])

<x-label for="{{$for}}">{{$label}}</x-label>

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full border-palette-200 dark:border-palette-70 bg-palette-100 dark:bg-palette-50 text-palette-300 dark:text-palette-10 focus:bg-white dark:focus:bg-palette-70 focus:border-palette-300 dark:focus:border-palette-40 focus:ring-palette-100 dark:focus:ring-black rounded-md shadow-sm']) !!}>
</textarea>

<x-input-error for="{{$for}}" />