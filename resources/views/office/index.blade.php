<x-layouts.office>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center">
            <p class=" font-bold text-sm text-azul-600 ">Link patrocinador lado izquierdo.</p>
            <div class=" flex items-center justify-center">
                <p class=" font-bold text-rojo-500 text-sm" id="p1">
                    http://multinivel.test/register/{{ $user->username }}/left</p>
                <button class=" ml-6 text-azul-500 hover:text-azul-600" onclick="copiarAlPortapapeles('p1')">
                    <i class="fas fa-copy mr-2"></i>Copiar
                </button>
            </div>

            <p class=" font-bold mt-4 text-sm text-azul-600 ">Link patrocinador lado derecho.</p>
            <div class=" flex items-center justify-center">
                <p class=" font-bold text-rojo-500 text-sm" id="p2">
                    http://multinivel.test/register/{{ $user->username }}/right</p>
                <button class=" ml-6 text-azul-500 hover:text-azul-600" onclick="copiarAlPortapapeles('p2')">
                    <i class="fas fa-copy mr-2"></i>Copiar
                </button>
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
