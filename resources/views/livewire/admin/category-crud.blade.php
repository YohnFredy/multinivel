<div>
    <h1 class=" font-bold mb-2 text-palette-200 dark:text-palette-30">
        {{ $isEditMode ? 'Editar ctegoria' : 'Crear categoria' }}</h1>
    <div
        class="p-4 rounded-lg bg-white dark:bg-palette-60 border border-palette-200 border-opacity-25 dark:border-none  shadow-lg shadow-palette-800 dark:shadow-none  ">

        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">
                <div class="col-span-6 md:col-span-4">
                    <x-input-l type="text" label="Nombre:" for="name" wire:model.live="name" required autofocus
                        autocomplete="name" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Producto activo:" nameOption="" for="is_active" wire:model="is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-select-l>
                </div>

                <div class="col-span-6">
                    <x-textarea-l label="Descripción:" for="description" wire:model.live="description" rows="3">
                    </x-textarea-l>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Categoría padre:" for="parent_id" wire:model.live="selectedCategory">
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
            </div>

            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="{{ route('admin.categories.index') }}"> <i class="fas fa-arrow-left"></i></a>
                <x-button type="submit" wire:loading.attr="disabled">{{ $isEditMode ? 'Actualizar' : 'Guardar' }}
                </x-button>
            </div>
        </form>
    </div>
</div>
