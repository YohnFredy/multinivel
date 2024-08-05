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
        if ($this->mainImageIndex > 0) {
            $this->mainImageIndex--;
        }
    }

    public function nextMainImage()
    {
        if ($this->mainImageIndex < count($this->product->images) - 1) {
            $this->mainImageIndex++;
        }
    }

    public function setMainImage($index)
    {
        $this->mainImageIndex = $index;
    }

    public function setThumbnailImage($index)
    {
        $this->mainImageIndex = $index;
    }

    public function prevThumbnailImage()
    {
        if ($this->thumbnailIndex > 0) {
            $this->thumbnailIndex -= $this->thumbnailCount;
            if ($this->thumbnailIndex < 0) {
                $this->thumbnailIndex = 0;
            }
        }
    }

    public function nextThumbnailImage()
    {
        $totalImages = count($this->product->images);
        if ($this->thumbnailIndex < $totalImages - $this->thumbnailCount) {
            $this->thumbnailIndex += $this->thumbnailCount;
            if ($this->thumbnailIndex > $totalImages - $this->thumbnailCount) {
                $this->thumbnailIndex = $totalImages - $this->thumbnailCount;
            }
        }
        
    }

    public function render()
    {
        return view('livewire.product-images-carousel');
    }
}
