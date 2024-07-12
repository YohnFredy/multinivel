@push('css')
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
@endpush


<div>
    <h1 class="font-bold mb-2 text-palette-200 dark:text-palette-10">Red Unilevel</h1>
    <div class="flex justify-center rounded-lg bg-white shadow-lg shadow-palette-30  dark:bg-palette-60  dark:shadow-none">
        <div class="caja">
            <div class="tree">
                <ul>
                    @include('livewire.office.tree.children-unilevel', ['node' => $tree])
                </ul>
            </div>
        </div>
    </div>
    <div class=" mt-6 rounded-md p-4 bg-white shadow-md shadow-palette-30 dark:bg-palette-60 dark:shadow-none">
        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sint laborum maxime error
            repellendus in porro beatae rerum nisi! Eos quisquam architecto facere! Assumenda odit dignissimos, magnam
            earum eum eius.</p>

        <p class=" text-center mx-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sint laborum maxime
            error repellendus in porro beatae rerum nisi! Eos quisquam architecto facere! Assumenda odit dignissimos,
            magnam earum eum eius.</p>
    </div>
    <div class=" mt-6 rounded-md p-4 bg-white shadow-md shadow-palette-30 dark:bg-palette-60 dark:shadow-none">
        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sint laborum maxime error
            repellendus in porro beatae rerum nisi! Eos quisquam architecto facere! Assumenda odit dignissimos, magnam
            earum eum eius.</p>

        <p class=" text-center mx-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sint laborum maxime
            error repellendus in porro beatae rerum nisi! Eos quisquam architecto facere! Assumenda odit dignissimos,
            magnam earum eum eius.</p>
    </div>
    
</div>

{{-- <pre>{{ json_encode($tree, JSON_PRETTY_PRINT) }}</pre> --}}
