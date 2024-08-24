<?php

namespace App\Livewire;

use Livewire\Component;

class ProductImagesCarousel extends Component
{
    public $product;
    public $mainImageIndex = 0;
    public $thumbnailIndex = 0;
    public $thumbnailCount = 4;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function prevMainImage()
    {
        $this->mainImageIndex = max(0, $this->mainImageIndex - 1);
    }

    public function nextMainImage()
    {
        $this->mainImageIndex = min(count($this->product->images) - 1, $this->mainImageIndex + 1);
    }

    public function setMainImage($index)
    {
        $this->mainImageIndex = $index;
    }

    public function prevThumbnailImage()
    {
        $this->thumbnailIndex = max(0, $this->thumbnailIndex - $this->thumbnailCount);
    }

    public function nextThumbnailImage()
    {
        $totalImages = count($this->product->images);
        $this->thumbnailIndex = min($totalImages - $this->thumbnailCount, $this->thumbnailIndex + $this->thumbnailCount);
    }

    public function addToCart(){

    }

    public function render()
    {
        return view('livewire.product-images-carousel');
    }
}
