<li>

    @if ($node['level'] < 3)
        <a wire:click="show({{ $node['id'] }} )" class="">
            <div class="grid grid-cols-2 gap-x-3 gap-y-1">
                <div class=" col-span-2 text-palette-300 dark:text-palette-10 font-bold">
                    <h4>{{ $node['username'] }}</h4>
                </div>
                <div class=" col-span-2 text-palette-300 dark:text-palette-10 font-bold">
                    {{-- <h6>$rango: {{ $node['rank'] }}</h6>
                    <h6> {{ $node['binary_commission'] }} </h6>
                    <h6> {{ $node['generational_commission'] }} </h6> --}}
                </div>

                <div class="col-span-2">
                    <h5 class=" text-palette-200 dark:text-palette-20"> <span
                            class=" text-palette-300 dark:text-palette-10 font-medium">Directos:</span>
                        {{ $node['total_direct'] }}</h5>
                </div>

                <div class="col-span-2">
                    <h5 class=" text-palette-200 dark:text-palette-20"><span
                            class="text-palette-400 dark:text-palette-10 font-medium">total:</span>
                        {{ $node['total_unilevel'] }}</h5>
                </div>
            </div>
        </a>
    @else
        <a wire:click="show({{ $node['id'] }} )" class="">
            <div class=" text-palette-300 dark:text-palette-10">
                <h6>{{ $node['username'] }}</h6>
            </div>
        </a>
    @endif


    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('livewire.office.tree.children-unilevel', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
