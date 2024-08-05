<div>

    <h1 class=" font-bold mb-2 text-palette-200 dark:text-palette-30">Productos</h1>
    <div
        class="p-4 rounded-lg bg-white dark:bg-palette-40 border border-palette-200 border-opacity-25 dark:border-none  shadow-lg shadow-palette-800 dark:shadow-none  ">

        <div class="flex items-center justify-between mb-6">
            <x-button type="button"> <a href="{{ route('admin.products.create') }}">Crear producto</a></x-button>
            {{-- Buscar productos --}}
            <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar producto" />
        </div>

        {{-- Tabla de prpductos  --}}
        <div class=" overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-palette-300 dark:text-palette-30 ">
                <thead
                    class="text-xs text-white dark:text-palette-10 uppercase
                bg-gradient-to-r from-palette-200 dark:from-palette-70  via-palette-150 dark:via-palette-50 to-palette-200 dark:to-palette-70 
                 ">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Imágenes</th>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Descripción</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <div wire:key="{{ $product->id }}">
                            <tr
                                class="bg-white border-b dark:bg-palette-80  border-palette-300 dark:border-palette-40 hover:bg-palette-10 dark:hover:bg-palette-60">

                                <th scope="row" class="px-6 py-4 whitespace-nowrap">

                                    @if ($product->latestImage)
                                        <img class=" h-10 mx-auto" src="{{ Storage::url($product->latestImage->path) }}"
                                            alt="{{ $product->name }}">
                                    @endif
                                </th>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4">{{ $product->price }}</td>

                                <td class="py-4 text-lg text-center">

                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="font-medium text-palette-200 hover:text-palette-150 dark:text-palette-30 dark:hover:text-white mr-2"><i
                                            class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" wire:click="delete({{ $product->id }})"
                                        wire:confirm="Esta seguuro de eliminar el producto {{ $product->name }} ?"
                                        class="font-medium text-palette-400 hover:text-opacity-75 dark:text-palette-40 dark:hover:text-white"><i
                                            class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="my-2">{{ $products->links() }}</div>
    </div>






























    {{--  <input type="text" wire:model="search" placeholder="Buscar productos..." class="input input-bordered mb-4" />
    
    <table class="table w-full">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">Editar</a>
                    <button wire:click="delete({{ $product->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }} --}}
</div>
