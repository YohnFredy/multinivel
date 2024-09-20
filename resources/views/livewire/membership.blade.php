<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class=" max-w-lg mx-auto px-4 py-8 bg-white rounded-md shadow-md shadow-gray-400 ">

        <h1 class=" text-center text-blue-600">
            REGISTRO FORNUVI
        </h1>

        <hr class=" mt-4 mb-8  border-blue-600">

        <form wire:submit="save">
            <div class="grid md:grid-cols-2 md:gap-x-6">

                <x-input-field wire:model.blur="form.name" type="text" name="form.name" label="Nombre" autofocus
                    autocomplete="form.name" />
                <x-input-field wire:model.blur="form.lastName" type="text" name="form.lastName" label="Apellidos"
                    autocomplete="form.lastName" />
                <x-input-field wire:model.live.debounce.1000ms="form.username" type="text" name="form.username"
                    id="username" label="Nombre de usurio" autocomplete="form.username" />
                <x-input-field wire:model.blur="form.identificationCard" type="text" name="form.identificationCard"
                    label="Identificacion" autocomplete="form.identificationCard" />
            </div>

            <x-input-field wire:model.blur="form.email" type="email" name="form.email" label="Email address"
                autocomplete="form.email" />

            <div class="grid md:grid-cols-2 md:gap-x-6">

                <x-input-radio label='Sexo'>
                    <div class=" flex items-center">
                        <input wire:model.blur="form.sex" class="mr-2" type="radio" id="male" name="gender"
                            value="male">
                        <label for="male">Masculino</label>
                    </div>
                    <div class="flex items-center">
                        <input wire:model.blur="form.sex" class="ml-5 mr-2" type="radio" id="female" name="gender"
                            value="female">
                        <label for="female">Femenino</label>
                    </div>
                </x-input-radio>

                <x-input-field wire:model.blur="form.birthdate" type="date" name="form.birthdate"
                    id="fecha de nacimiento" label="fecha de nacimiento" />

                <x-input-field wire:model.blur="form.phone" type="text" name="form.phone" label="Telefono" />

                <x-select-field wire:model.live="selectedCountry" name="selectedCountry" label="Pais">
                    <option value="" hidden>Seleccionar un pais</option>
                    @foreach ($countries as $country)
                        <option class=" text-gray-800" value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </x-select-field>

                @if ($selectedCountry)
                    <x-select-field wire:model.live="selectedDepartment" name="selectedDepartment" label="Departamento">
                        <option value="" hidden>Seleccionar departamento</option>
                        @foreach ($departments as $department)
                            <option class=" text-gray-800" value="{{ $department['id'] }}">{{ $department['name'] }}
                            </option>
                        @endforeach
                    </x-select-field>

                    @if ($selectedDepartment)
                        @if (count($cities) > 0)
                            <x-select-field wire:model.live="selectedCity" name="selectedCity" label="Ciudad">
                                <option value="" hidden>Seleccionar una ciudad</option>
                                @foreach ($cities as $city)
                                    <option class=" text-gray-800" value="{{ $city['id'] }}">{{ $city['name'] }}
                                    </option>
                                @endforeach
                            </x-select-field>
                        @else
                            <x-input-field wire:model.blur="addCity" type="text" name="addCity"
                                label="Ciudad" />
                        @endif
                    @endif
                @endif
            </div>

            <x-input-field wire:model="form.address" type="text" name="form.address" label="Dirección" />

            <x-input-field wire:model.live.debounce.750ms="form.password" type="password" name="form.password"
                label="Password"  />

            <x-input-field wire:model.live.debounce.750ms="form.password_confirmation" type="password"
                name="form.password_confirmation" label="Confirmar Password" />

            <div class="grid md:grid-cols-2 md:gap-x-6">
                <x-input-field wire:model="form.sponsor" type="text" name="form.sponsor" label="Sponsor" disabled />
                <x-input-field wire:model="form.position" type="text" name="form.position" label="Posición"
                    disabled />
            </div>

            <div class=" mb-6">
                <x-checkbox wire:model="form.terms" class="mr-2" /> I agree to
                <x-link href="{{ route('terms.show') }}">
                    Terms of Service
                </x-link>
                and
                <x-link href="{{ route('policy.show') }}">
                    Privacy Policy
                </x-link>
                <div>
                    @error('form.terms')
                        <span class="error text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class=" text-center">
                <x-submit-button class=" w-full">guardar registro</x-submit-button>
            </div>


            <div class=" text-right mt-3 ">
                <x-link href="http://fornuvi.test/">
                    Pagina de inicio</x-link>
            </div>

        </form>
    </div>

    <x-dialog-modal wire:model="confirmingRegistration">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-blue-500">
                Confirmación de Registro
            </h2>
        </x-slot>

        {{-- <x-slot name="content">
                <p class="text-lg text-gray-700">
                    ¡Gracias por registrarte, fredy!
                </p>
                <p class="mt-4 text-gray-600">
                    Hemos enviado un correo de confirmación a xxx@gmail.com. Por favor, revisa tu bandeja de entrada y sigue las instrucciones para verificar tu cuenta.
                </p>
                <p class="mt-4 text-gray-600">
                    Si no recibes el correo en unos minutos, por favor revisa tu carpeta de spam o contáctanos para asistencia.
                </p>
            </x-slot> --}}

        <x-slot name="content">
            <p class="text-lg text-gray-700">
                ¡Gracias por registrarte, {{ $form->name }}!
            </p>
            <p class="mt-4 text-gray-600">
                Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a todas las funcionalidades de nuestra
                plataforma.
            </p>
            <p class="mt-4 text-gray-600">
                Aquí tienes tus detalles de registro:
            </p>
            <ul class="mt-2 list-disc list-inside text-gray-600">
                <li><strong>Nombre de Usuario:</strong> {{ $form->username }}</li>
                <li><strong>Email:</strong> {{ $form->email }} </li>
            </ul>
            <p class="mt-4 text-gray-600">
                Puedes empezar a explorar y utilizar nuestras funciones. Si tienes alguna pregunta o necesitas ayuda, no
                dudes en contactarnos.
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingRegistration', false)">
                Cerrar
            </x-secondary-button>


            <x-submit-button class="ml-2" wire:click="redirectToHome" autofocus>
                Ir a la página de inicio
            </x-submit-button>
        </x-slot>
    </x-dialog-modal>

    <script>
        // Selecciona el campo de entrada
        var usernameInput = document.getElementById('username');

        // Añade un evento 'input' para eliminar espacios en tiempo real
        usernameInput.addEventListener('input', function() {
            this.value = this.value.replace(/\s+/g, '');
        });
    </script>
</div>
