@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-palette-200 dark:text-palette-10">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-palette-300 dark:text-palette-20">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4  dark:bg-palette-40 text-end">
        {{ $footer }}
    </div>
</x-modal>
