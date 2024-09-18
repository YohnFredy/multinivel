<div>
    {{-- Tabla de prpductos  --}}
    <div class=" overflow-x-auto">
        <table class="min-w-full text-sm text-left rtl:text-right text-palette-300 dark:text-palette-30 ">
            <thead
                class="text-xs text-white dark:text-palette-10 uppercase bg-gradient-to-r from-palette-200 dark:from-palette-70  via-palette-150 dark:via-palette-50 to-palette-200 dark:to-palette-70">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Id</th>
                    <th scope="col" class="px-6 py-3">Rango</th>
                    <th scope="col" class="px-6 py-3">Comisión Binaria</th>
                    <th scope="col" class="px-6 py-3">Comisión Generaciones</th>
                    <th scope="col" class="px-6 py-3">Comisión Diamante </th>
                    <th scope="col" class="px-6 py-3">Comisión Corona</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranks as $rank)
                    <div wire:key="{{ $rank->id }}">
                        <tr
                            class="bg-white border-b dark:bg-palette-80  border-palette-300 dark:border-palette-40 hover:bg-palette-10 dark:hover:bg-palette-60">

                            <th scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ $rank->user_id }}


                            </th>
                            <td class="px-6 py-4">{{ $rank->level }}</td>
                            <td class="px-6 py-4">{{ number_format($rank->commission->binary_commission, 2) }}</td>
                            <td class="px-6 py-4">{{ number_format($rank->commission->generational_commission, 2) }}
                            </td>
                            <td class="px-6 py-4">0</td>
                            <td class="px-6 py-4">
                                {{ number_format($total = $rank->commission->binary_commission + $rank->commission->generational_commission, 2) }}
                            </td>

                            <td class="py-4 text-lg text-center">

                                <a href=""
                                    class="font-medium text-palette-200 hover:text-palette-150 dark:text-palette-30 dark:hover:text-white mr-2"><i
                                        class="fas fa-edit"></i>
                                </a>
                                <button type="button" wire:click="delete("
                                    wire:confirm="Esta seguuro de eliminar el producto {{ $rank->name }} ?"
                                    class="font-medium text-palette-400 hover:text-opacity-75 dark:text-palette-40 dark:hover:text-white"><i
                                        class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>

        <div class="my-2">{{ $ranks->links() }}</div>

    </div>
</div>
