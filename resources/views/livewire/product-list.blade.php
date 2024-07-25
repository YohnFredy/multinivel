<div>
    <!-- Filtros de Categoría y Subcategoría -->
    <div class="mb-4 flex justify-between items-center">
        <div>
            <select wire:model="category_id" class="border rounded p-2">
                <option value="">Todas las Categorías</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <select wire:model="subcategory_id" class="border rounded p-2 ml-2">
                <option value="">Todas las Subcategorías</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Lista de Productos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="border rounded shadow p-4 flex flex-col">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4">
                <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                <div class="mt-auto">
                    <span class="text-lg font-semibold text-green-600">{{ $product->price }} €</span>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full">No hay productos disponibles.</p>
        @endforelse
    </div>
</div>

