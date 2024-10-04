<div>
    <h1 class=" font-bold mb-2 text-palette-200 dark:text-palette-30">
        {{ $isEditMode ? 'Editar producto' : 'Crear porducto' }}</h1>
    <div
        class="p-4 rounded-lg bg-white dark:bg-palette-60 border border-palette-200 border-opacity-25 dark:border-none  shadow-lg shadow-palette-800 dark:shadow-none  ">

        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}" x-on:submit="$refs.fileInput.value = ''">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">
                <div class="col-span-6 md:col-span-2">
                    <x-input-l type="text" label="Nombre:" for="form.name" wire:model.live="form.name" required autofocus
                        autocomplete="form.name" />
                </div>
                <div class=" col-span-6 md:col-span-1">
                    <x-input-l type="number" label="Precio:" for="form.price" wire:model.blur="form.price"
                        step="0.01" min="0" required />
                </div>
                <div class=" col-span-6 md:col-span-1 relative">
                    <span class=" absolute right-0  text-palette-400 text-xs">{{ $suggestedPts }}</span>
                    <x-input-l type="number" label="Pts:" for="pts" wire:model="form.pts" step="0.01"
                        min="0" required />
                </div>
                <div class="col-span-6 md:col-span-1">
                    <x-input-l type="number" label="Descuento %:" for="form.maximum_discount"
                        wire:model="form.maximum_discount" min="0" required />
                </div>
                <div class="col-span-6 md:col-span-1">
                    <x-input-l type="number" label="Stock:" for="form.stock" wire:model="form.stock" min="0"
                        required />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Tangible:" nameOption="" for="form.tangible" wire:model="form.tangible">
                        <option value="1">tangible</option>
                        <option value="0">intangible</option>
                    </x-select-l>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Permitir pedidos pendientes:" nameOption="" for="form.allow_backorder"
                        wire:model="form.allow_backorder">
                        <option value="1">Permitir</option>
                        <option value="0">No permitir</option>
                    </x-select-l>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Producto activo:" nameOption="" for="form.is_active"
                        wire:model="form.is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-select-l>
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="descripcion:">Descripcion:</x-label>
                    <textarea id="editor" wire:model.live="form.description"> {{ $form->description }}
                    </textarea>
                    <x-input-error for="form.description" />
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="Specifications">Specifications:</x-label>
                    <textarea id="editor2" wire:model.live="form.specifications"> {{ $form->specifications }}
                    </textarea>
                    <x-input-error for="form.specifications" />
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="information">Information:</x-label>
                    <textarea id="editor3" wire:model.live="form.information"> {{ $form->information }}
                    </textarea>
                    <x-input-error for="form.information" />
                </div>


                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Categoría:" for="form.category_id" wire:model.live="selectedCategory">
                        <option value="" hidden>Seleccionar</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select-l>
                </div>

                @if ($subcategories)
                    <div class="col-span-6 md:col-span-2">
                        <x-select-l label="Subcategoría:" for="subcategory_id" wire:model.live="selectedSubcategory">
                            <option value="" hidden>Seleccionar</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </x-select-l>
                    </div>
                @endif

                @if ($subsubcategories)
                    <div class="col-span-6 md:col-span-2">
                        <x-select-l label="Sub-subcategoría:" for="subsubcategory_id"
                            wire:model.live="selectedSubsubcategory">
                            <option value="" hidden>Seleccionar</option>
                            @foreach ($subsubcategories as $subsubcategory)
                                <option value="{{ $subsubcategory->id }}">{{ $subsubcategory->name }}</option>
                            @endforeach
                        </x-select-l>
                    </div>
                @endif

                <div class="col-span-6 md:col-span-2">
                    @if ($brands)
                        <x-select-l label="Marca:" for="form.brand_id" wire:model="form.brand_id">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </x-select-l>
                    @endif
                </div>

                <div class="col-span-6 form-group">
                    <x-input-file-l label="Imagenes:" for="form.newImages" wire:model="form.newImages"
                        x-ref="fileInput" wire:loading.attr="disabled" />
                </div>
            </div>

            @if ($isEditMode)
                <div class=" mt-4">
                    <x-label>Imágenes Existentes:</x-label>
                    <div class="grid grid-cols-6 gap-2 ">
                        @foreach ($form->images as $image)
                            <div
                                class="col-span-2 md:col-span-1  relative bg-white shadow-md shadow-palette-300 dark:shadow-none border border-palette-200 dark:border-palette-80 rounded-lg flex items-center justify-center p-2">
                                <div class="">
                                    <img src="{{ Storage::url($image) }}" class="h-20" alt="Imagen del Producto">
                                    <button type="button" wire:confirm="Esta seguuro de eliminar la imagen ?"
                                        class=" absolute top-2 right-2 font-bold text-palette-400"
                                        wire:click="removeImage('{{ $image }}')">X</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="{{ route('admin.products.index') }}"> <i class="fas fa-arrow-left"></i></a>
                <x-button type="submit" wire:loading.attr="disabled">{{ $isEditMode ? 'Actualizar' : 'Guardar' }}
                </x-button>
            </div>
        </form>
    </div>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('form.description', editor.getData());
                    });
                })
                .catch(error => {
                    Console.error(error);
                });
        </script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor2'))
                .then(function(editor2) {
                    editor2.model.document.on('change:data', () => {
                        @this.set('form.specifications', editor2.getData());
                    });
                })
                .catch(error => {
                    Console.error(error);
                });
        </script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor3'))
                .then(function(editor3) {
                    editor3.model.document.on('change:data', () => {
                        @this.set('form.information', editor3.getData());
                    });
                })
                .catch(error => {
                    Console.error(error);
                });
        </script>
    @endpush
</div>

