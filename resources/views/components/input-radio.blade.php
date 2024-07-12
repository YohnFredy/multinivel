@props(['label'])
<div class="relative z-0 w-full mb-5 group">
    <div
        class=" flex py-2.5 px-0 w-full text-sm text-gray-900 border-0 border-b-2 border-gray-300 dark:text-white dark:border-gray-600">

        {{ $slot }}

        <label for="{{ $label }}"
            class="absolute text-sm text-gray-500 dark:text-gray-400 -translate-y-6 scale-75 top-3 origin-[0] ">{{ $label }}</label>
    </div>
</div>
