<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Página de Pago</h1>
                    
                    <h2>Producto 1</h2>
                    {{-- <x-bold-payment-button 
                        :order-id="'ORDER1-' . now()->timestamp"
                        currency="COP"
                        amount="100000"
                        :api-key="config('services.bold.api_key')"
                        :integrity-signature="$integritySignature1"
                        description="Camiseta Rolling Stones S"
                        tax="vat-19"
                        redirection-url="https://micomercio.com/pagos/resultado"
                        button-id="payment-button-1"
                    /> --}}

                    {{-- <h2>Producto 2</h2>
                    <x-bold-payment-button 
                        :order-id="'ORDER2-' . now()->timestamp"
                        currency="COP"
                        amount="150000"
                        :api-key="config('services.bold.api_key')"
                        :integrity-signature="$integritySignature2"
                        description="Camiseta Rolling Stones M"
                        tax="vat-19"
                        redirection-url="https://micomercio.com/pagos/resultado"
                        button-id="payment-button-2"
                    /> --}}

                    

                    <div id="custom-controls" class="mt-4">
                        <h3>Controles personalizados</h3>
                        <button onclick="showAmount('payment-button-1')">Mostrar monto del Producto 1</button>
                        {{-- <button onclick="updateAmount('payment-button-2', '180000')">Actualizar monto del Producto 2</button> --}}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/bold-checkout.js') }}"></script>
        <script src="{{ asset('js/bold-checkout-manager.js') }}"></script>
        <script>
            function showAmount(buttonId) {
                const amount = BoldCheckoutManager.getAmount(buttonId);
                alert('El monto actual es: ' + amount);
            }

            function updateAmount(buttonId, newAmount) {
                if (BoldCheckoutManager.updateAmount(buttonId, newAmount)) {
                    alert('Monto actualizado correctamente');
                } else {
                    alert('No se pudo actualizar el monto');
                }
            }

            function openCheckout(buttonId) {
                BoldCheckoutManager.openCheckout(buttonId);
            }
        </script>
    @endpush
</x-app-layout>