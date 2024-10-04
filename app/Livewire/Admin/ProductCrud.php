<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Admin\ProductForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class ProductCrud extends Component
{
    use WithFileUploads;
    public ProductForm $form;

    public $isEditMode = false;
    public $suggestedPts;
    public $product, $content;
    public $selectedCategory, $selectedSubcategory, $selectedSubsubcategory;
    public $categories, $subcategories, $subsubcategories, $brands;

    public function mount(Product $product)
    {
        $this->categories = Category::whereNull('parent_id')->get();
        $this->brands = Brand::all();
        $this->product = $product;

        if ($this->product->exists) {
            $this->loadProductData();
            $this->isEditMode = true;
        }
    }

    public function loadProductData()
    {
        $this->form->fill($this->product->toArray());
        $this->form->images = $this->product->images->pluck('path')->toArray();

        $this->populateCategoryData($this->form->category_id);
    }

    public function populateCategoryData($categoryId)
    {
        $categories = [];
        $currentCategory = Category::find($categoryId);

        while ($currentCategory) {
            array_unshift($categories, $currentCategory);
            $currentCategory = $currentCategory->parent;
        }

        $this->selectedCategory = $categories[0]->id ?? null;
        $this->selectedSubcategory = $categories[1]->id ?? null;
        $this->selectedSubsubcategory = $categories[2]->id ?? null;

        if ($this->selectedSubcategory !== null) {
            $this->subcategories = Category::where('parent_id', $this->selectedCategory)->get();
        }
        if ($this->selectedSubsubcategory !== null) {
            $this->subsubcategories = Category::where('parent_id', $this->selectedSubcategory)->get();
        }
    }

    public function updatedSelectedCategory($categoryId)
    {
        $this->selectedSubcategory = null;
        $this->selectedSubsubcategory = null;
        $this->form->category_id = $categoryId;
        $this->subcategories = Category::where('parent_id', $categoryId)->get();

        $this->subcategories = Category::where('parent_id', $categoryId)->get();
        if (!count($this->subcategories) > 0) {
            $this->subcategories = false;
        }
        $this->subsubcategories = false;
    }

    public function updatedSelectedSubcategory($subcategoryId)
    {
        $this->selectedSubsubcategory = null;
        $this->form->category_id = $subcategoryId;
        $this->subsubcategories = Category::where('parent_id', $subcategoryId)->get();
        $this->subsubcategories  = Category::where('parent_id', $subcategoryId)->get();
        if (!count($this->subsubcategories) > 0) {
            $this->subsubcategories = false;
        }
    }

    public function updatedSelectedSubsubcategory($subsubcategoryId)
    {
        $this->form->category_id = $subsubcategoryId;
    }

    public function save()
    {
        $this->form->store();
        $this->resetForm();
    }

    public function update()
    {
        $this->form->update($this->product);
        $this->resetForm();
    }

    public function removeImage($path)
    {
        $this->form->images = array_filter($this->form->images, fn($image) => $image !== $path);
        Storage::delete('public/' . $path);
        $this->product->images()->where('path', $path)->delete();
    }

    private function resetForm()
    {
        $this->form->reset();
        $this->loadProductData();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        if ($this->form->price) {
            $this->suggestedPts = number_format($this->form->price * 0.20, 2, '.', ',');
        }
        return view('livewire.admin.product-crud');
    }
}
