<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-6 gap-6 mt-6">
        <div class="col-span-6 md:col-span-4">
            <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4 mt-2">

                <x-input-l wire:model.live="contact" type="text" label="Nombre:" for="contact" required autofocus autocomplete="contact"
                    placeholder="Ingrese el nombre de la persona que recibirá el producto  " />


                <div class=" mt-3">
                    <x-input-l wire:model.live="phone" type="text" label="Teléfono:" for="phone" required 
                        autocomplete="phone" placeholder="Ingrese el número de teléfono de contacto " />
                </div>
            </div>

            <div x-data="{ envio_type: @entangle('envio_type')}" class="mt-6">
                <p class=" font-bold">Envios</p>
                <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4 mt-2">
                    <div class=" flex justify-between">
                        <div class="flex items-center">
                            <input wire:model="envio_type" wire:change="onEnvioTypeChange" type="radio" x-model="envio_type" name="envio_type" value="1"
                                class=" text-palette-200 bg-palette-10 border-palette-300 focus:ring-palette-150 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="envio_type_1" class="ml-2 font-medium  dark:text-palette-30">Recojo en
                                tineda</label>
                        </div>
                        <div class=" ml-2 font-medium  dark:text-palette-30">Gratis</div>
                    </div>
                </div>

                <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4 mt-4">
                    <div class="flex items-center">
                        <input wire:model.live="envio_type" wire:change="onEnvioTypeChange"  type="radio" x-model="envio_type" name="envio_type" value="2"
                            class=" text-palette-200 bg-palette-10 border-palette-300 focus:ring-palette-150 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="envio_type_1" class="ml-2 font-medium  dark:text-palette-30">Envio a
                            domicilio</label>
                    </div>

                    <div class="hidden mt-4" :class="{ 'hidden': envio_type != 2 }">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-2 md:col-span-1">
                                <x-select-l wire:model.live="country_id" label="Pais:" for="country_id">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </x-select-l>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <x-select-l wire:model.live="state_id" label="Departamento:" for="state_id">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </x-select-l>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <x-select-l wire:model.live="city" label="Ciudad:" for="city">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </x-select-l>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <x-input-l wire:model="address" type="text" label="Dirección:" for="address" required
                                    placeholder="Ingrese dirección " />
                            </div>
                            <div class="col-span-2">
                                <x-input-l wire:model="reference" type="text" label="Referencia:" for="reference" required
                                    placeholder="Ingrese referencia " />
                            </div>
                        </div>
                    </div>
                </div>

                <x-button wire:loading.attr="disabled" wire:target="create_order" wire:click="create_order" class="mt-6"> Continuar con la compra</x-button>

                <div class=" py-4">
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, incidunt eligendi! Vel, ab?
                        Nostrum optio inventore id nam expedita, neque blanditiis veritatis ipsa iusto ullam odit, eos
                        voluptatem ad nisi? <a class=" text-palette-400 hover:text-opacity-85" href="http://">Politicas
                            y Privaciddad.</a></p>
                </div>
            </div>
        </div>
        <div class="col-span-6 md:col-span-2">

            <div class="col-span-6 md:col-span-2">
                <h2>Resumen de la orden</h2>
                <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4 mt-2">
                    <ul class=" divide-y">
                        <li class=" flex justify-between py-2">
                            <p>Productos ({{ $quantity }})
                            </p>
                            <p> ${{ $total }}</p>
                        </li>

                        <li class=" flex justify-between py-2">
                            <p>total:
                            </p>
                            <p> ${{ $total }}</p>
                        </li>
                    </ul>
                </div>

            </div>







        </div>
    </div>
</div>
