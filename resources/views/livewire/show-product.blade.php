<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white pt-6 pb-8 mt-2 rounded-md shadow-md shadow-palette-300">
        <div class="grid grid-cols-6 divide-x">
            <div class="col-span-3 px-10">
                <a class="flex items-center cursor-pointer ">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <h5>Home</h5> 
                </a>
                
            
                @livewire('product-images-carousel', ['product' => $product])

            </div>
            <div class="col-span-3 mt-4 px-10">
                <h1 class="text-palette-200 font-bold uppercase">{{ $product->name }}</h1>
                <p class="mt-6">{{ $product->description }}</p>
                <h1 class="mt-6 text-palette-200 font-bold">$ {{ $product->price }}</h1>
                <p class="text-palette-400 font-bold">Pts: {{ $product->pts }}</p>
                <div class="flex items-center py-6">
                    <button wire:click="decrement" class="bg-palette-200 py-1 px-3 rounded-md hover:bg-palette-150 text-palette-20 hover:text-white">-</button>
                    <input wire:model.live="count" type="text" class="text-center w-16 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none" value="{{ $count }}">
                    <button wire:click="increment" class="bg-palette-200 py-1 px-3 rounded-md hover:bg-palette-150 text-palette-20 hover:text-white">+</button>
                </div>
                <div class="mt-8">
                    <x-button>agregar al carro</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-6 p-4 mt-6 rounded-md shadow-md shadow-palette-300">
        <div class="grid grid-cols-2 gap-10">
            <div class="pl-6">
                <h2>Especificaciones</h2>
                <hr class="border-b-2 border-palette-300">
                <p class="pt-6">{{ $product->specifications }}</p>
            </div>
            <div class="col-span-1 pr-6">
                <h2>Información adicional</h2>
                <hr class="border-b-2 border-palette-300">
                <p class="pt-6">{{ $product->information }}</p>
            </div>
        </div>
    </div>

    <div class="h-4"></div>
</div>
