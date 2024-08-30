<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Order Number -->
        <div class="bg-white rounded-lg p-6 shadow-md shadow-palette-300 mb-6">
            <p class="text-lg font-semibold text-palette-400 uppercase">Orden ID: {{ $order->id }}</p>
        </div>

        <!-- Shipping and Contact Details -->
        <div class="bg-white rounded-lg p-6 shadow-md shadow-palette-300 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Shipping Details -->
                <div>
                    <p class="text-lg font-semibold text-palette-200 uppercase mb-4">Detalles de Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="">Recogida en tienda:</p>
                        <p class="">Calle 15 #42, Cali, Valle del Cauca</p>
                    @else
                        <p class="">Envío a la dirección:</p>
                        <p class="">{{ $order->address }} - {{ $order->reference }}</p>
                        <p class="">{{ $order->country->name }} - {{ $order->state->name }} - {{ $order->city->name }} {{ $order->addCity }}</p>
                    @endif
                </div>

                <!-- Contact Details -->
                <div>
                    <p class="text-lg font-semibold text-palette-200 uppercase mb-4">Contacto</p>
                    <p class="">Recibe: {{ $order->contact }}</p>
                    <p class="">Teléfono: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-lg p-6 shadow-md shadow-palette-300 mb-6">
            <p class="text-lg font-semibold text-palette-200 uppercase mb-4">Resumen de Pedido</p>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-palette-200 text-white uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-center"></th>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2 text-center">Cant</th>
                            <th class="px-4 py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b border-palette-300 hover:bg-palette-10">
                                <td class="px-4 py-3 text-center">
                                    @if ($item->product->latestImage)
                                        <img src="{{ asset('storage/' . $item->product->latestImage->path) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="Default Image" class="w-12 h-12 object-cover rounded">
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item->name }}</td>
                                <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($item->price * $item->quantity, 2) }} USD</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-white rounded-lg p-6 shadow-md shadow-palette-300">
            <div class=" flex-1 md:flex items-center justify-between">
                <img src="https://www.agenciatravelfest.com/wp-content/uploads/2022/10/logos-medios-de-pago.jpg" class=" h-28 object-cover" alt="Logo">
                <div class="text-right">
                    <p class="">Subtotal: ${{ number_format($order->total - $order->shipping_cost, 2) }} USD</p>
                    <p class="">Costo de Envío: {{ number_format($order->shipping_cost, 2) }} USD</p>
                    <p class="text-lg font-semibold">Total: {{ number_format($order->total, 2) }} USD</p>
                    <div class=" mt-2">
                        <x-button>
                            Pagar
                        </x-button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
