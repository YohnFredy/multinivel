<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class=" max-w-lg mx-auto px-4 py-8 bg-white rounded-md shadow-md shadow-gray-400 ">

        <h1 class=" text-center text-blue-600">
            Registro Multinivel
        </h1>

        <hr class=" mt-4 mb-8  border-blue-600">

        <form wire:submit="save">
            <div class="grid md:grid-cols-2 md:gap-x-6">
                <x-input-field wire:model.blur="form.name" type="text" name="form.name" label="Nombre" required autofocus
                    autocomplete="form.name" />
                <x-input-field wire:model.blur="form.last_name" type="text" name="form.last_name" label="Apellidos"
                    required autocomplete="form.last_name" />
                <x-input-field wire:model.live.debounce.1000ms="form.username" type="text" name="form.username"
                    id="username" label="Nombre de usurio" required autocomplete="form.username" />
                <x-input-field wire:model.blur="form.identification_card" type="text" name="form.identification_card"
                    label="Identificacion" required autocomplete="form.identification_card" />
            </div>

            <x-input-field wire:model.blur="form.email" type="email" name="form.email" label="Email address" required
                autocomplete="form.email" />

            <div class="grid md:grid-cols-2 md:gap-x-6">

                <x-input-radio label='Sexo'>
                    <div class=" flex items-center">
                        <input wire:model.blur="form.sex" class="mr-2" type="radio" id="male" name="gender"
                            value="male" required>
                        <label for="male">Masculino</label>
                    </div>
                    <div class="flex items-center">
                        <input wire:model.blur="form.sex" class="ml-5 mr-2" type="radio" id="female" name="gender"
                            value="female" required>
                        <label for="female">Femenino</label>
                    </div>
                    {{-- <div class="flex items-center">
                                <input wire:model.blur="form.sex" class=" ml-5 mr-2" type="radio" id="other" name="gender" value="other" required>
                                <label for="other">Otro</label>
                            </div> --}}
                </x-input-radio>

                <x-input-field wire:model.blur="form.birthdate" type="date" name="form.birthdate"
                    id="fecha de nacimiento" label="fecha de nacimiento" required />

                <x-input-field wire:model.blur="form.phone" type="text" name="form.phone" label="Telefono"
                    required />

                <x-select-field wire:model.live="country_id" name="form.country_id" label="Pais">
                    <option value="" hidden>Seleccionar un pais</option>
                    @foreach ($countries as $country)
                        <option class=" text-gray-800" value="{{ $country->id }}">{{ $country->name }}
                        </option>
                    @endforeach
                </x-select-field>

                <x-select-field wire:model.live="form.state_id" name="form.state_id" label="Departamento">
                    <option value="" hidden>Seleccionar departamento</option>
                    @foreach ($states as $state)
                        <option class=" text-gray-800" value="{{ $state->id }}">{{ $state->name }}
                        </option>
                    @endforeach
                </x-select-field>



                <x-input-field wire:model="form.city" type="text" name="form.city" label="Ciudad" />
            </div>

            <x-input-field wire:model="form.address" type="text" name="form.address" label="Dirección" />

            <x-input-field wire:model.live="form.password_confirmation" type="password"
                name="form.password_confirmation" label="Password" required autocomplete="form.new-password" />

            <x-input-field wire:model.live="form.password" type="password" name="form.password"
                label="Confirmar Password" required autocomplete="form.new-password" />

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
                <x-link href="http://multinivel.test/">
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
