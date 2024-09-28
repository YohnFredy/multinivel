<x-layouts.admin>
    <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4">

 <div class=" grid grid-cols-4 gap-4">
            <div class=" col col-span-1">
                @livewire('admin.point-value')
            </div>
            <div class=" col col-span-1">
                @livewire('admin.generate-commissions')
            </div>

            <div class=" col col-span-1">
                @livewire('admin.update-rank')
            </div>
            <div class=" col col-span-1">
                @livewire('admin.commission-by-depth-levels')
            </div> 
        </div>
    </div>

    <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4 mt-4">
        @livewire('admin.commission-data');
    
    </div> 
    
</x-layouts.admin>
