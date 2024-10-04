<x-app-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white dark:bg-palette-50 p-6 rounded-lg shadow-lg shadow-palette-300 dark:shadow-none">
            <h1 class="text-2xl font-bold  mb-4">{{ $message }}</h1>
            <p class=" mb-4">Estado de la transacción: <strong>{{ $status }}</strong></p>
            <p class="">Identificador de la orden: <strong>{{ $orderId }}</strong></p>
            <div class="mt-6">
                @if($status === 'approved' )
                    <a href="" class="bg-palette-200 text-palette-20 hover:text-white px-4 py-2 rounded hover:bg-palette-150">Ver mis pedidos</a>
                @else
                    <a href="" class="bg-palette-200 px-4 py-2 rounded hover:bg-palette-150">Volver a la tienda</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>