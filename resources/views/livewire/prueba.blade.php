<div>

    <form action="http://fornuvi.test/webhook/tu-endpoint" method="POST">
        @csrf
    
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Edad:</label>
            <input type="number" name="age" id="age" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="{{ old('age') }}">
            @error('age')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar</button>
    </form>
</div>
    
</div>
