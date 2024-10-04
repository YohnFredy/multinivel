<x-layouts.office>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center">

            <p class=" font-bold text-sm text-palette-400 ">Link patrocinador lado derecho.</p>
            <div class="flex_1 items-center justify-center mb-8">
                <p id="p1" class=" hidden">http://fornuvi.test/register/{{ $user->username }}/right</p>
                <div class=" mb-4">
                    <button class=" ml-6 text-palette-200 hover:text-palette-300 hover:underline"
                        onclick="copiarAlPortapapeles('p1')">
                        Clic para Copiar <i class="fas fa-copy mr-2"></i>
                    </button>
                </div>
                <x-link href="{{ route('membership', [$user->username, 'right']) }}">
                    <x-button>Registrar lado derecho</x-button>
                </x-link>
            </div>
            <p class=" font-bold text-sm text-palette-400 ">Link patrocinador lado izquierdo.</p>
            <div class="flex_1 items-center justify-center mb-8">
                <p id="p2" class=" hidden">http://fornuvi.test/register/{{ $user->username }}/left</p>
                <div class=" mb-4">
                    <button class=" ml-6 text-palette-200 hover:text-palette-300 hover:underline"
                        onclick="copiarAlPortapapeles('p2')">
                        Clic para Copiar <i class="fas fa-copy mr-2"></i>
                    </button>
                </div>
                <x-link href="{{ route('membership', [$user->username, 'left']) }}">
                    <x-button>Registrar lado Izquierdo</x-button>
                </x-link>
            </div>
        </div>
    </div>
    <script>
        function copiarAlPortapapeles(id_elemento) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
        }
    </script>
</x-layouts.office>
