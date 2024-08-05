<div>
    {{-- Main Image Carousel --}}
    <div class="relative w-full overflow-hidden">
        <div class="flex transition-transform duration-500" style="transform: translateX(-{{ $mainImageIndex * 100 }}%);">
            @foreach ($product->images as $index => $image)
                <div class="flex-none w-full">
                    <div class="flex justify-center">
                        <div wire:key="main-{{ $index }}">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                class=" h-96 object-contain rounded-lg">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($product->images) > 1)
            <button wire:click="prevMainImage" aria-label="Previous"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 py-2 px-3 text-2xl bg-palette-20 bg-opacity-60 text-palette-200 hover:text-palette-300">«</button>

            <button wire:click="nextMainImage" aria-label="Next"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 py-2 px-3 text-2xl bg-palette-20 bg-opacity-60 text-palette-200 hover:text-palette-300">»</button>
            <div class="absolute inset-x-0 bottom-5 flex justify-center space-x-2">
                @foreach ($product->images as $index => $image)
                    <button wire:click="setMainImage({{ $index }})"
                        class="w-2 h-2 rounded-full {{ $mainImageIndex === $index ? 'bg-palette-30' : 'bg-palette-40' }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Thumbnails Carousel --}}
    @if (count($product->images) > 1)
        <div class="relative flex justify-center mt-2">
            <div class="px-20">
                <div class="w-full overflow-hidden">
                    <div class="flex transition-transform duration-500"
                        style="transform: translateX(-{{ $thumbnailIndex * (100 / $thumbnailCount) }}%);">
                        @foreach ($product->images as $index => $image)
                            <div wire:click="setMainImage({{ $index }})" class="flex-none cursor-pointer"
                                style="width: {{ count($product->images) < 2 ? '100%' : 100 / $thumbnailCount . '%' }};">
                                <div wire:key="thumb-{{ $index }}"
                                    class="flex justify-center {{ $loop->last ? '' : 'mr-2' }}">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                        class="h-14 object-contain rounded-md">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button wire:click="prevThumbnailImage" aria-label="Previous"
                class="absolute left-12 bottom-2 p-2 bg-palette-30 bg-opacity-60 text-lg text-palette-200 hover:text-palette-300 font-bold">«</button>
            <button wire:click="nextThumbnailImage" aria-label="Next"
                class="absolute right-12 bottom-2 p-2  bg-palette-30 bg-opacity-60 text-lg text-palette-200 hover:text-palette-300 font-bold">»</button>
        </div>
    @endif
</div>
