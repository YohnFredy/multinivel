<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-2">
                    <div class=" flex justify-between">
                        <div class="flex items-center">
                            <input wire:model="envio_type" wire:change="onEnvioTypeChange" type="radio"
                                x-model="envio_type" name="envio_type" value="1"
                                class="text-palette-200 bg-palette-10 dark:text-black border-palette-300  focus:ring-palette-150 dark:focus:ring-white dark:ring-offset-palette-80 focus:ring-2 dark:bg-palette-80 dark:border-palette-20">
                            <label for="envio_type_1" class="ml-2 font-medium  dark:text-palette-30">Recojo en
                                tineda</label>
                        </div>
                        <div class=" ml-2 font-medium">Gratis</div>
                    </div>
                </div>

                <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-4">
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
                                    <x-select-l wire:model.live="selectedState" label="Departamento:"
                                        for="selectedState">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </x-select-l>
                                </div>
                                @if ($selectedState)
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
                                <x-input-l wire:model.blur="address" type="text" label="Dirección:" for="address"
                                    required placeholder="Ingrese dirección " />
                            </div>
                        </div>
                        <div class=" mt-2">
                            <x-input-l wire:model.blur="reference" type="text" label="Referencia:" for="nota"
                                placeholder="Ingrese referencia" />
                        </div>

                    </div>
                </div>
            </div>

            <x-button wire:loading.attr="disabled" wire:target="create_order" wire:click="create_order" class="mt-6">
                Continuar con la compra</x-button>

            <div class=" py-4">
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, incidunt eligendi! Vel, ab?
                    Nostrum optio inventore id nam expedita, neque blanditiis veritatis ipsa iusto ullam odit, eos
                    voluptatem ad nisi? <a class=" text-palette-400 dark:text-white font-semibold hover:text-opacity-85 dark:hover:text-opacity-85" href="http://">Politicas
                        y Privaciddad.</a></p>
            </div>
        </div>
        <div class="col-span-6 md:col-span-2">

            <div class="col-span-6 md:col-span-2">
                <h2>Resumen de la orden</h2>
                <div class=" bg-white dark:bg-palette-40 rounded-md shadow-md shadow-palette-300 dark:shadow-none p-4 mt-2">
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
                            <p> ${{ number_format($shipping_cost,0) }}</p>
                        </li>

                        <li class=" flex justify-between py-2">
                            <p>Total:
                            </p>
                            <p> ${{ number_format($total,0) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
