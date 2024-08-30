<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class=" flex py-6">
        <div class=" w-72">
            @livewire('categories')
        </div>
        <div class="w-full">
            <div class="flex justify-end">
                <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar producto" />
            </div>

            <div class=" grid grid-cols-8 gap-5 pt-4 ml-6">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                            <div class=" col-span-2">
                                <div wire:key="{{ $product->id }}">
                                <a href="{{ route('product.show', $product) }}"
                                    class="bg-white dark:bg-palette-10 shadow-md shadow-palette-300 rounded-lg overflow-hidden flex flex-col">

                                    @if ($product->latestImage)
                                        <img src="{{ asset('storage/' . $product->latestImage->path) }}"
                                            alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="Default Image"
                                            class="w-full h-48 object-cover">
                                    @endif

                                    <div class=" pt-2 pb-4 px-4">
                                        <p class="text-palette-200 dark:text-palette-80 font-bold uppercase">{{ $product->name }}</p>
                                        <p class=" dark:text-palette-60 mt-2 line-clamp-3 ">{{ $product->description }}</p>
                                        <div class="text-right">
                                            <p class="text-palette-200 dark:text-palette-70 mt-2">${{ $product->price }}</p>
                                            <h5 class=" text-palette-400 dark:text-palette-50 ">Pts: {{ $product->pts }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class=" col-span-8 h-72 flex items-center justify-center">
                        <h1 class=" font-bold text-palette-200">No hay productos para mostrar en esta categoria</h1>
                    </div>
                @endif
            </div>
            <div class="my-4 ml-6">{{ $products->links() }}</div>

        </div>
    </div>
</div>
