<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-palette-40 pt-6 pb-8 mt-2 rounded-md shadow-md shadow-palette-300 dark:shadow-none ">
        <div class="grid grid-cols-6 divide-x">
            <div class="col-span-3 px-10">
                <a class="flex items-center cursor-pointer ">
                    <i class="fas fa-long-arrow-alt-left mr-2"></i>
                    <h5 class="dark:text-palette-20">Home</h5>
                </a>
                @livewire('product-images-carousel', ['product' => $product])
            </div>
            <div class="col-span-3 mt-4 px-10">
                <h1 class="text-palette-200 dark:text-white font-bold uppercase">{{ $product->name }}</h1>
                <p class="mt-6 dark:text-palette-20">{{ $product->description }}</p>
                <h1 class="mt-6 text-palette-200 dark:text-palette-10 font-bold">$ {{ $product->price }}</h1>
                <p class="text-palette-400 dark:text-palette-20 font-bold">Pts: {{ $product->pts }}</p>

                <div class="flex items-center py-6">
                    <button wire:click="decrement"
                        class="bg-palette-200 dark:bg-palette-30  py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-70 hover:text-white dark:hover:text-palette-80">-</button>
                    <input wire:model.live.debounce.2000ms="quantity" type="number"
                        class="text-center w-16 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none px-0 dark:bg-palette-40"
                        value="{{ $quantity }}">
                    <button wire:click="increment"
                        class="bg-palette-200 dark:bg-palette-30  py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-70 hover:text-white dark:hover:text-palette-80">+</button>
                </div>

                <div class="mt-8">
                    <x-button wire:click="addToCart">agregar al carro</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-palette-40 py-6 p-4 mt-6 rounded-md shadow-md shadow-palette-300 dark:shadow-none">
        <div class="grid grid-cols-2 gap-10">
            <div class="pl-6">
                <h2>Especificaciones</h2>
                <hr class="border-b-2 border-palette-300 dark:border-palette-30">
                <p class="pt-6">{{ $product->specifications }}</p>
            </div>
            <div class="col-span-1 pr-6">
                <h2>Información adicional</h2>
                <hr class="border-b-2 border-palette-300 dark:border-palette-30">
                <p class="pt-6">{{ $product->information }}</p>
            </div>
        </div>
    </div>
    <div class="h-4"></div>

    <x-dialog-modal wire:model="modalCart" maxWidth="3xl">
        <x-slot name="title">
            <div class=" flex justify-between items-center">
                <div class=" flex items-center">
                    <i class=" text-palette-500  text-3xl far fa-check-circle mr-2"> </i>
                    <h3> Lo que llevas en tu Carro</h3>
                </div>
                <div>
                    <h3>X</h3>
                </div>
            </div>
            <hr class=" mt-2">
        </x-slot>

        <x-slot name="content">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-palette-20">
                <tbody>
                    <tr class="">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-md"
                                src="{{ asset('storage/' . $product->latestImage->path) }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $product->name }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            ${{ $product->price }}
                        </td>

                        <td class="px-6 py-4">
                            Pts: {{ $product->pts }}
                        </td>
                        <td class="px-6 py-4">
                            Cantidad: {{ $quantity }}
                        </td>

                    </tr>

                </tbody>
            </table>

        </x-slot>

        <x-slot name="footer">


            <div class="flex items-center">
                <x-link href="{{ route('products') }}" class="focus:outline-none mr-4 ">
                    Seguir Comprando</x-link>

                <x-link href="{{ route('cart') }}">
                    <x-button>Ir al carro</x-button></x-link>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
