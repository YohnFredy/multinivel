<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
    <div class="grid grid-cols-6 gap-6 mt-6">
        <div class="col-span-6 md:col-span-4">
            <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-2">

                <x-input-l wire:model.blur="name" type="text" label="Nombre:" for="name" required autofocus
                    autocomplete="name" placeholder="Ingrese el nombre de la persona que recibirá el producto " />

                <div class=" mt-3">
                    <x-input-l wire:model.blur="phone" type="text" label="Teléfono:" for="phone" required
                        autocomplete="phone" placeholder="Ingrese el número de teléfono de contacto " />
                </div>
            </div>

            <div x-data="{ envio_type: @entangle('envio_type') }" class="mt-6">
                <p class=" font-bold">Envios</p>
                <div
                    class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-4">
                    <div class="flex items-center">
                        <input wire:model="envio_type" wire:change="onEnvioTypeChange" type="radio"
                            x-model="envio_type" name="envio_type" value="2"
                            class=" text-palette-200 bg-palette-10 dark:text-black border-palette-300  focus:ring-palette-150 dark:focus:ring-white dark:ring-offset-palette-80 focus:ring-2 dark:bg-palette-80 dark:border-palette-20">
                        <label for="envio_type_1" class="ml-2 font-medium  dark:text-palette-30">Envio a
                            domicilio</label>
                    </div>
                    <div class="hidden mt-4" :class="{ 'hidden': envio_type != 2 }">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-2 md:col-span-1">
                                <x-select-l wire:model.live="selectedCountry" label="Pais:" for="selectedCountry">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </x-select-l>
                            </div>
                            @if ($selectedCountry)
                                <div class="col-span-2 md:col-span-1">
                                    <x-select-l wire:model.live="selectedDepartment" label="Departamento:"
                                        for="selectedDepartment">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </x-select-l>
                                </div>
                                @if ($selectedDepartment)
                                    @if (count($cities) > 0)
                                        <div class="col-span-2 md:col-span-1">
                                            <x-select-l wire:model.live="selectedCity" label="Ciudad:"
                                                for="selectedCity">
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </x-select-l>
                                        </div>
                                    @else
                                        <div class="col-span-2 md:col-span-1">
                                            <x-input-l wire:model.blur="addCity" type="text" label="Ciudad:"
                                                for="addCity" required placeholder="Ingrese ciudad" />
                                        </div>
                                    @endif
                                @endif
                            @endif

                            <div class="col-span-2 md:col-span-1">
                                <x-input-l wire:model="address" type="text" label="Dirección:" for="address"
                                    required placeholder="Ingrese dirección " />
                            </div>
                        </div>
                        <div class=" mt-2">
                            <x-input-l wire:model="additionalAddress" type="text" label="Referencia:" for="nota"
                                placeholder="Ingrese referencia" />
                        </div>

                        <div class=" mt-4 bg-palette-10 dark:bg-palette-60  rounded-lg p-4">
                            <p class=" font-bold text-palette-400 dark:text-white ">Información sobre el envío.</p>

                            <p class="mt-2 text-justify">Queremos informarte que el costo del envío se pagará al momento
                                de recibir tu producto. Esto
                                significa que solo necesitarás realizar el pago del valor del artículo a través de
                                nuestra
                                pasarela de pago segura.
                            </p>
                            <p class="mt-2 text-justify"> El monto del envío se abonará directamente al repartidor en el
                                momento de la entrega.</p>
                            <p class="mt-2 text-justify"> Si tienes alguna duda, no dudes en contactarnos al correo
                                <strong>contacto@fornuvi.com</strong> ¡Estamos aquí para ayudarte!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class=" hidden md:block bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-4">
                <div class="flex items-center">
                    <x-checkbox wire:model="terms" class="mr-2" />
                    @livewire('purchase-policy-and-conditions')
                </div>
                <div>
                    @error('terms')
                        <span class="error text-sm text-palette-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-button wire:loading.attr="disabled" wire:target="create_order" wire:click="create_order"
                        class="mt-6">
                        Continuar con la compra</x-button>
                </div>
            </div>
        </div>
        <div class="col-span-6 md:col-span-2">

            <div class="col-span-6 md:col-span-2">
                <h2>Resumen de la orden</h2>
                <div
                    class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-2">
                    <ul class=" divide-y">
                        <li class=" flex justify-between py-2">
                            <p>Productos ({{ $quantity }})
                            </p>
                            <p> ${{ number_format($subTotal, 2) }}</p>
                        </li>
                        @if ($discount > 0)
                            <li class=" flex justify-between py-2">
                                <p>Descuento:
                                </p>
                                <p> ${{ number_format($discount, 0) }}</p>
                            </li>
                        @endif

                        <li class=" flex justify-between py-2">
                            <p>Envio:
                            </p>
                            <p> ${{ number_format($shipping_cost, 0) }}</p>
                        </li>

                        <li class=" flex justify-between py-2">
                            <p>Total:
                            </p>
                            <p> ${{ number_format($total, 0) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div
            class="col-span-6 md:col-span-2 md:hidden bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-4">
            <div class="flex items-center">
                <x-checkbox wire:model="terms" class="mr-2" />
                @livewire('purchase-policy-and-conditions')
            </div>
            <div>
                @error('terms')
                    <span class="error text-sm text-palette-400">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <x-button wire:loading.attr="disabled" wire:target="create_order" wire:click="create_order"
                    class="mt-6">
                    Continuar con la compra</x-button>
            </div>
        </div>
    </div>

</div>
