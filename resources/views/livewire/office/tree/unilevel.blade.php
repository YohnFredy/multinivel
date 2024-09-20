@push('css')
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
@endpush


<div>
    <h1 class="font-bold mb-2 text-palette-200 dark:text-palette-10">Red Unilevel</h1>
    <div class="flex justify-center rounded-lg bg-white shadow-lg shadow-palette-300  dark:bg-palette-60  dark:shadow-none">
        <div class="caja">
            <div class="tree">
                <ul>
                    @include('livewire.office.tree.children-unilevel', ['node' => $tree])
                </ul>
            </div>
        </div>
    </div>
    <div class=" mt-6 rounded-md p-4 bg-white shadow-md shadow-palette-300 dark:bg-palette-60 dark:shadow-none">
        <p class="mb-4"></p>

        <p class=" text-center mx-6"></p>
    </div>
    <div class=" mt-6 rounded-md p-4 bg-white shadow-md shadow-palette-300 dark:bg-palette-60 dark:shadow-none">
        <p class="mb-4"></p>

        <p class=" text-center mx-6"></p>
    </div>
    
</div>

{{-- <pre>{{ json_encode($tree, JSON_PRETTY_PRINT) }}</pre> --}}
