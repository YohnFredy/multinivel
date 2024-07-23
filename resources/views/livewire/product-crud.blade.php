<!-- resources/views/livewire/product-crud.blade.php -->
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" wire:model="description"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="text" class="form-control" id="price" wire:model="price">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="newImages">Nuevas Imágenes</label>
            <input type="file" class="form-control" id="newImages" wire:model="newImages" multiple>
            @error('newImages.*') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @if ($updateMode)
            <div class="form-group">
                <label>Imágenes Existentes</label>
                <div>
                    @foreach($images as $image)
                        <div class="d-inline-block position-relative">
                            <img src="{{ Storage::url($image) }}" width="100" alt="Imagen del Producto">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" wire:click="removeImage('{{ $image }}')">X</button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Actualizar' : 'Guardar' }}</button>
        @if ($updateMode)
            <button type="button" class="btn btn-secondary" wire:click="cancel">Cancelar</button>
        @endif
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imágenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @foreach($product->images as $image)
                            <img src="{{ Storage::url($image->path) }}" width="50" alt="{{ $product->name }}">
                        @endforeach
                    </td>
                    <td>
                        <button wire:click="edit({{ $product->id }})" class="btn btn-warning">Editar</button>
                        <button wire:click="delete({{ $product->id }})" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

