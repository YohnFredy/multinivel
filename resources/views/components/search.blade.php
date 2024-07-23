@props(['placeholder' => 'Search', 'disabled' => false])

<div>
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative w">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-palette-500 dark:text-palette-20" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' =>
                'block pt-2 ps-10 text-sm text-palette-300  border border-palette-300 rounded-lg w-full md:w-60 lg:w-80 bg-palette-100 focus:ring-palette-200 focus:border-palette-200 dark:text-palette-10 dark:border-palette-80 dark:bg-palette-70  dark:placeholder-palette-30  dark:focus:ring-palette-30 dark:focus:border-palette-80',
        ]) !!} type="text"
            placeholder="{{ $placeholder }}">
    </div>
</div>
