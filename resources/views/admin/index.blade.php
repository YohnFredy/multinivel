<x-layouts.admin>
    <div class=" bg-white rounded-md shadow-md shadow-palette-300 p-4">

        <div class=" grid grid-cols-2 gap-8">
            <div class=" col col-span-1">
                @livewire('admin.point-value')
            </div>
            <div class=" col col-span-1">
                @livewire('admin.generate-commissions')
            </div>
          
        </div>
        

    </div>
    
</x-layouts.admin>
