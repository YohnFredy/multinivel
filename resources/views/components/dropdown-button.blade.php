<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center py-2 border border-transparent
                        bg-white text-palette-200 hover:text-palette-300 text-sm leading-4 font-medium rounded-md  focus:outline-none focus:bg-palette-100 focus:text-palette-300 active:bg-palette-100 dark:bg-palette-70 dark:text-palette-30 dark:hover:text-white dark:focus:text-white dark:focus:bg-palette-70 transition ease-in-out duration-150',
    ]) }}>

    {{ $slot }}

    <svg class="ms-2 -me-0.5 h-4 w-4 text-palette-500 dark:text-palette-10" xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
    </svg>
</button>
