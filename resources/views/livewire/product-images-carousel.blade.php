<div>
    {{-- Main Image Carousel --}}
    <div class="w-full relative overflow-hidden ">
        <div class="flex transition-transform duration-500" style="transform: translateX(-{{ $mainImageIndex * 100 }}%);">
            @foreach ($product->images as $index => $image)
                <div class=" flex-none w-full">
                    <div class=" flex justify-center">
                        <div wire:key="main-{{ $index }}">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                class=" h-96 object-contain  ">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button wire:click="prevMainImage" aria-label="Previous"
            class="absolute left-8 top-1/2 transform -translate-y-1/2  p-2 text-2xl text-palette-200 hover:text-palette-300 ">«</button>
        <button wire:click="nextMainImage" aria-label="Next"
            class="absolute right-8 top-1/2 transform -translate-y-1/2 p-2 text-2xl text-palette-200 hover:text-palette-300">»</button>
        <div class="absolute inset-x-0 bottom-5 flex justify-center">
            @foreach ($product->images as $index => $image)
                <button wire:click="setMainImage({{ $index }})"
                    class="w-2 h-2 rounded-full {{ $loop->last ? '' : 'mr-2' }} {{ $mainImageIndex === $index ? 'bg-palette-30 bg-opacity-35' : 'bg-palette-40 bg-opacity-35' }}">
                </button>
            @endforeach
        </div>
    </div>

    {{-- Thumbnails Carousel --}}
    <div class=" relative">
        <div class="px-20 mt-2 ">
            <div class="w-full overflow-hidden">
                <div class="flex transition-transform duration-500"
                    style="transform: translateX(-{{ ($thumbnailIndex * 100) / $thumbnailCount }}%);">

                    @foreach ($product->images as $index => $image)
                       
                            <div wire:click="setThumbnailImage({{ $index }})"
                                class="   justify-center flex-none w-1/{{ $thumbnailCount }}">
                                <div wire:key="thumb-{{ $index }}" class=" w-full">
                                    <div class=" flex justify-center {{ $loop->last ? '' : 'mr-2' }} cursor-pointer ">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                            class=" h-14  object-contain">
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button wire:click="prevThumbnailImage" aria-label="Previous"
            class="absolute left-12 bottom-1 p-2 text-lg text-palette-200 hover:text-palette-300  font-bold ">«</button>
        <button wire:click="nextThumbnailImage" aria-label="Next"
            class="absolute right-12 bottom-1 p-2 text-lg text-palette-200 hover:text-palette-300 font-bold">»</button>
    </div>
</div>
