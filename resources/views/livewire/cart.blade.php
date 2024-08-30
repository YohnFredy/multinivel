<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class=" grid grid-cols-6 gap-6 mt-6">
        <div class=" col-span-6 md:col-span-4 ">

            <h2>Carro ({{ $quantity }} productos)</h2>
            <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 p-4 mt-2">

                <div class=" grid grid-cols-12 gap-2 mt-2">
                    @if ($products)
                        @foreach ($products as $product)
                            <div class=" col-span-2 lg:col-span-1 flex items-center justify-center">
                                <img class=" w-16 h-16 rounded-md" src="{{ asset('storage/' . $product['path']) }}"
                                    alt="Jese image">
                            </div>
                            <div class="col-span-10 lg:col-span-5 flex items-center">
                                <div class=" text-sm">
                                    <p class=" font-bold">
                                        {{ $product['name'] }}
                                    </p>

                                    <p class=" mt-2">{{ $product['description'] }}</p>
                                </div>
                            </div>

                            <div class="col-span-5 lg:col-span-2 flex items-center justify-center">
                                <div class=" text-sm">
                                    <p class="">
                                        ${{ $product['price'] }}
                                    </p>

                                    <p class=" mt-2"> Pts: {{ $product['pts'] }}</p>
                                </div>
                            </div>

                            <div class="col-span-5 lg:col-span-3 flex items-center justify-center">
                                <div>
                                    <button wire:click="decrement({{ $product['index'] }})"
                                        class="bg-palette-200 dark:bg-palette-30 py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-60 hover:text-white dark:hover:text-palette-80">-</button>
                                    <input type="text"
                                        class="text-center p-0 w-14 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none dark:bg-palette-40"
                                        wire:model.live.debounce.1000ms="products.{{ $product['index'] }}.quantity"
                                        value="{{ $product['quantity'] }}">
                                    <button wire:click="increment({{ $product['index'] }})"
                                        class="bg-palette-200 dark:bg-palette-30 py-1 px-3 rounded-md hover:bg-palette-150 dark:hover:bg-white text-palette-20 dark:text-palette-60 hover:text-white dark:hover:text-palette-80">+</button>
                                </div>
                            </div>

                            <div wire:click="removeFromCart({{ $product['index'] }})"
                                class="col-span-2 lg:col-span-1 flex items-center justify-center cursor-pointer text-palette-400 hover:text-opacity-80 dark:text-palette-30 dark:hover:text-palette-10  ">
                                <i class="  text-lg fas fa-trash"></i>
                            </div>

                            <div class="col-span-12">
                                <div class=" my-2 border-b border-palette-300 dark:border-palette-10">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class=" col-span-12  flex items-center justify-center">

                            <p class=" py-4 text-lg font-bold">No hay productos en el carro</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-span-6 md:col-span-2">
            <h2>Resumen de la orden</h2>
            <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 p-4 mt-2">
                <ul class=" divide-y">
                    <li class=" flex justify-between py-2">
                        <p>Productos ({{ $quantity }})
                        </p>
                        <p> ${{ $total }}</p>
                    </li>

                    <li class=" flex justify-between py-2">
                        <p>total:
                        </p>
                        <p> ${{ $total }}</p>
                    </li>
                </ul>

                <div class=" flex justify-center mt-6">
                    <a href="{{ route('orders.create') }}">
                        <x-button>continuar compra</x-button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
