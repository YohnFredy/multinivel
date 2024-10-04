<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
    <div class="bg-white dark:bg-palette-40 pt-6 pb-8 mt-6 rounded-md shadow-md shadow-palette-300 dark:shadow-none ">
        <div class=" grid grid-cols-10 gap-6 px-10 md:px-4 lg:px-10 ">
            <div class="col-span-10 md:col-span-6 lg:col-span-5">
                <a  href="{{ url()->previous() }}" class="flex items-center cursor-pointer hover:text-palette-200  mb-2">
                    <i class="fas fa-long-arrow-alt-left mr-2"></i>
                    <h5 class="dark:text-palette-20">Home</h5>
                </a>
              <div class=" flex justify-center"> <div class=" max-w-96"> @livewire('product-images-carousel', ['product' => $product])</div class=" w-96"></div>
            </div>

            <div class="col-span-10 md:col-span-4 lg:col-span-5 mt-6">
                <h1 class="text-palette-400 dark:text-white font-bold uppercase">{{ $product->name }}</h1>
                <div class=" text-justify  dark:text-palette-10 mt-2 md:mt-6">
                    <p>{!! $product->description !!}</p>
                </div>
                <h1 class="mt-3 md:mt-6 text-palette-200 dark:text-palette-10 font-bold">
                    ${{ number_format($product->price, 0) }}</h1>
                <p class="text-palette-400 dark:text-palette-20 font-bold">Pts: {{ $product->pts }}</p>

                <div class=" mt-6">
                    <button wire:click="decrement"
                        class="bg-palette-200 dark:bg-palette-30 py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-60 hover:text-white dark:hover:text-palette-80">-</button>
                    <input type="text"
                        class="text-center p-0 w-14 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none dark:bg-palette-40"
                        type="number" wire:model.live="quantity" min="1" max="100" step="1" x-data
                        x-on:input="$el.value = Math.max(1, Math.min(100, $el.value))">
                    <button wire:click="increment"
                        class="bg-palette-200 dark:bg-palette-30 py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-60 hover:text-white dark:hover:text-palette-80">+</button>
                </div>

                <div class="mt-8">
                    <x-button wire:click="addToCart">agregar al carro</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-palette-40 mt-6 rounded-md shadow-md shadow-palette-300 dark:shadow-none ">
        <div class="grid grid-cols-2 gap-10 p-8">
            <div class="col-span-2 md:col-span-1 text-justify">
                <h2 class=" text-palette-200 dark:text-palette-10">Especificaciones</h2>
                <hr class="border-b-2 border-palette-300 dark:border-palette-30">
                <p class="pt-6">{!! $product->specifications !!}</p>
            </div>
            <div class="col-span-2 md:col-span-1 text-justify">
                <h2 class=" text-palette-200 dark:text-palette-10">Información adicional</h2>
                <hr class="border-b-2 border-palette-300 dark:border-palette-30">
                <p class="pt-6">{!! $product->information !!}</p>
            </div>
        </div>
    </div>


    <x-dialog-modal wire:model="modalCart">
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
                            <img class="w-10 h-10 rounded-md border border-palette-20"
                                src="{{ asset('storage/' . $product->latestImage->path) }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $product->name }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            ${{ number_format($product->price, 0) }}
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
