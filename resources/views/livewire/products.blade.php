<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class=" grid grid-cols-10 gap-4 md:gap-10 mt-6 mb-10">
        <div class=" col-span-10 sm:col-span-4 md:col-span-3 lg:col-span-3 xl:col-span-2 ">
            @livewire('categories')
        </div>

        <div class=" col-span-10 sm:col-span-6 md:col-span-7 lg:col-span-7 xl:col-span-8 ">
            <div class="flex justify-end">
                <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar producto" />
            </div>

            <div class="grid grid-cols-12 gap-2 sm:gap-3 md:gap-4 mt-6" wire:init="loadPost">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <div class="col-span-6 md:col-span-6 lg:col-span-4 xl:col-span-3">
                            <div wire:key="{{ $product->id }}" class="h-full flex flex-col justify-between">
                                <a href="{{ route('product.show', $product) }}"
                                    class="bg-white dark:bg-palette-10 shadow-md shadow-palette-300 rounded-lg overflow-hidden flex flex-col h-full">

                                    <!-- Imagen del producto -->
                                    @if ($product->latestImage)
                                        <img src="{{ asset('storage/' . $product->latestImage->path) }}"
                                            alt="{{ $product->name }}" class="object-cover">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="Default Image"
                                            class="w-full h-48 object-cover">
                                    @endif
                                    <!-- Contenido del producto -->
                                    <div class="flex-grow pt-2 pb-4 px-4 flex flex-col justify-between border-t border-palette-30">
                                        <!-- Nombre del producto -->
                                        <p class="text-palette-200 dark:text-palette-80 font-bold uppercase">
                                            {{ $product->name }}</p>

                                        <!-- Descripción del producto -->
                                        <div class=" text-sm md:text-base">
                                            <p class=" dark:text-palette-60 mt-2 line-clamp-3">
                                                {!! Str::limit($product->description, 100) !!}
                                            </p>
                                        </div>

                                        <!-- Precio y puntos -->
                                        <div class="text-right mt-4">
                                            <p class="text-palette-200 dark:text-palette-70">
                                                ${{ number_format($product->price, 0) }}
                                            </p>
                                            <h5 class="text-palette-400 dark:text-palette-50">
                                                Pts: {{ $product->pts }}
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    @if ($readyToLoad == true)
                        <div class="col-span-4 h-72 flex items-center justify-center">
                            <h1 class=" font-bold text-palette-200">No hay productos para mostrar en esta categoria
                            </h1>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="flex items-center justify-center">
                                <div class=" mt-10">
                                    <div class=" flex justify-center">
                                        <svg aria-hidden="true"
                                            class="inline w-14 h-14 text-palette-20 animate-spin dark:text-palette-30 fill-palette-200"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </div>
                                    <div class="flex justify-center mt-2">
                                        <h3 class=" font-semibold text-palette-200">Cargando Productos...</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="my-4">{{ $products->links() }}</div>
        </div>
    </div>
</div>
