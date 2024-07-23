<div>
    <h1 class=" font-bold mb-2 text-palette-200 dark:text-palette-30">Productos</h1>
    <div
        class="p-4 rounded-lg bg-white dark:bg-palette-40 border border-palette-200 border-opacity-25 dark:border-none  shadow-lg shadow-palette-800 dark:shadow-none  ">

        <div class="flex items-center justify-between mb-6">
            <x-button type="button" wire:click="createProduct">crear producto</x-button>
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
                                    <button type="button" wire:click="edit({{ $product->id }})"
                                        class="font-medium text-palette-200 hover:text-palette-150 dark:text-palette-30 dark:hover:text-white mr-2"><i
                                            class="fas fa-edit"></i>
                                    </button>
    
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

    {{-- modal crear, mostrar, editar, productos  --}}
    <x-dialog-modal wire:model="modalProduct" maxWidth="3xl">
        <x-slot name="title">
            <h2 class=" font-semibold">
                @if ($updateMode)
                    Editar Producto
                @else
                    Crear producto
                @endif
            </h2>
            <hr class=" my-2 border-palette-200 dark:border-palette-30">
        </x-slot>

        <x-slot name="content">
            @if (session()->has('message'))
                <div class="">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'save' }}" x-on:submit="$refs.fileInput.value = ''">
                <div class=" grid grid-cols-9 gap-4 gap-y-2">
                    <div class="col-span-9 md:col-span-5">
                        <x-input-l type="text" label="Nombre:" for="form.name" wire:model.live="form.name" required autofocus
                            autocomplete="form.name" />
                    </div>
                    <div class="col-span-9 md:col-span-2">
                        <x-input-l type="text" label="Precio:" for="form.stock" wire:model.live="form.stock"
                            required />
                    </div>
                    <div class=" col-span-9 md:col-span-2">
                        <x-input-l type="text" label="Stock:" for="form.price" wire:model="form.price" required />
                    </div>
                    <div class="col-span-9">
                        <x-textarea-l label="Descripción:" for="form.description" wire:model.live="form.description"
                            rows="3">
                        </x-textarea-l>
                    </div>
                    <div class="col-span-9 md:col-span-3">

                        @if ($categories)
                            <x-select-l label="Categoria:" for="form.category_id" wire:model="form.category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select-l>
                        @else
                            <x-select-l label="Categoria" for="form.category_id" nameOption="sin"
                                wire:model="form.category_id">
                            </x-select-l>
                        @endif
                    </div>
                    <div class="col-span-9 md:col-span-3">
                        @if ($subcategories)
                            <x-select-l label="Subcategoria:" for="form.subcategory_id" nameOption=""
                                wire:model="form.subcategory_id">
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </x-select-l>
                        @else
                            <x-select-l label="Subcategoria:" for="form.subcategory_id" nameOption="sin"
                                wire:model="form.subcategory_id">
                            </x-select-l>
                        @endif
                    </div>

                    <div class="col-span-9 md:col-span-3">
                        @if ($brands)
                            <x-select-l label="Marca:" for="form.brand_id" wire:model="form.brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </x-select-l>
                        @else
                            <x-select-l label="Marca:" for="form.brand_id" nameOption="sin" wire:model="form.brand_id">
                            </x-select-l>
                        @endif
                    </div>

                    <div class="col-span-9 form-group">
                        <x-input-file-l label="Imagenes:" for="form.newImages" wire:model="form.newImages"
                            x-ref="fileInput" wire:loading.attr="disabled" />
                    </div>
                </div>

                @if ($updateMode)
                    <div class=" mt-4">
                        <x-label>Imágenes Existentes:</x-label>
                        <div class="grid grid-cols-4 gap-2 ">
                            @foreach ($form->images as $image)
                                <div
                                    class="col-span-2 md:col-span-1  relative bg-white shadow-md shadow-palette-300 dark:shadow-none border border-palette-200 dark:border-palette-80 rounded-lg flex items-center justify-center p-2">
                                    <div class="">
                                        <img src="{{ Storage::url($image) }}" class="h-20"
                                            alt="Imagen del Producto">
                                        <button type="button"  wire:confirm="Esta seguuro de eliminar la imagen ?"
                                            class=" absolute top-2 right-2 font-bold text-palette-400"
                                            wire:click="removeImage('{{ $image }}')">X</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class=" flex justify-end mt-4">
                    <x-secondary-button wire:click="$set('modalProduct', false)" class=" mr-4">
                        Cerrar
                    </x-secondary-button>

                    <x-button type="submit"
                        wire:loading.attr="disabled">{{ $updateMode ? 'Actualizar' : 'Guardar' }}
                    </x-button>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-dialog-modal>
</div>
