<div>
    <h1 class=" font-bold mb-2 text-palette-200 dark:text-palette-30">Marca</h1>
    <div
        class="p-4 rounded-lg bg-white dark:bg-palette-40 border border-palette-200 border-opacity-25 dark:border-none  shadow-lg shadow-palette-800 dark:shadow-none  ">

        <div class="flex items-center justify-between mb-6">
            <x-button type="button" wire:click="createBrand">crear Marca</x-button>
            {{-- Buscar Marca --}}
            <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar Marca" />
        </div>

        {{-- Tabla de Marcas  --}}
        <div class=" overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-palette-300 dark:text-palette-30 ">
                <thead
                    class="text-xs text-white dark:text-palette-10 uppercase
                bg-gradient-to-r from-palette-200 dark:from-palette-70  via-palette-150 dark:via-palette-50 to-palette-200 dark:to-palette-70 
                 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <div wire:key="{{ $brand->id }}">
                            <tr
                                class="bg-white border-b dark:bg-palette-80  border-palette-300 dark:border-palette-40 hover:bg-palette-10 dark:hover:bg-palette-60">
    
                                
                                <td class="px-6 py-4">{{ $brand->name }}</td>
                               
                                <td class="py-4 text-lg text-center">
                                    <button type="button" wire:click="edit({{ $brand->id }})"
                                        class="font-medium text-palette-200 hover:text-palette-150 dark:text-palette-30 dark:hover:text-white mr-2"><i
                                            class="fas fa-edit"></i>
                                    </button>
    
                                    <button type="button" wire:click="delete({{ $brand->id }})"
                                        wire:confirm="Esta seguuro de eliminar la Marca {{ $brand->name }} ?"
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
        <div class="my-2">{{ $brands->links() }}</div>
    </div>

    {{-- modal crear, mostrar, editar, Marca  --}}
    <x-dialog-modal wire:model="modalBrand" maxWidth="3xl">
        <x-slot name="title">
            <h2 class=" font-semibold">
                @if ($updateMode)
                    Editar Marca
                @else
                    Crear Marca
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

            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'save' }}">
                <div class=" grid grid-cols-9 gap-4 gap-y-2">
                    <div class="col-span-9 md:col-span-5">
                        <x-input-l type="text" label="Nombre:" for="name" wire:model.live="name" required autofocus
                            autocomplete="name" />
                    </div>
                </div>

                <div class=" flex justify-end mt-4">
                    <x-secondary-button wire:click="$set('modalBrand', false)" class=" mr-4">
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


