<div>
    <h4 class=" font-bold">Valor punto:
        @if ($income)
            {{ number_format($ptsValue,2) }}
        @else
            0
        @endif
    </h4>

    <div class=" col-span-6 md:col-span-1">
        <x-input-l type="number" label="Valor Dolar:" for="dolar" wire:model.blur="dolar" step="0.01" min="0"
            required />
    </div>


    <x-button class=" mt-2" type="button" wire:click="updatePointValue" wire:loading.attr="disabled">
        Actualizar valor pts
    </x-button>
</div>
