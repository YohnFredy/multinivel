<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryCrud extends Component
{
    #[Validate('required|string|min:3|max:100')]
    public $name = "";
    #[Validate('string|max:255')]
    public  $description = '';
    #[Validate('required|boolean')]
    public  $is_active = '';

    public $category, $isEditMode = false, $parent_id = '';
    public $selectedCategory, $selectedSubcategory, $selectedSubsubcategory;
    public $categories, $subcategories, $subsubcategories;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->categories = Category::whereNull('parent_id')->get();

        if ($this->category->exists) {
            $this->loadCategoryData();
            $this->isEditMode = true;
        }
    }

    public function loadCategoryData()
    {
        $this->fill($this->category->toArray());
        $this->populateCategoryData($this->category->id);
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
        $this->parent_id = $categoryId;
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
        $this->parent_id = $subcategoryId;
        $this->subsubcategories = Category::where('parent_id', $subcategoryId)->get();
        $this->subsubcategories  = Category::where('parent_id', $subcategoryId)->get();
        if (!count($this->subsubcategories) > 0) {
            $this->subsubcategories = false;
        }
    }

    public function updatedSelectedSubsubcategory($subsubcategoryId)
    {
        $this->parent_id = $subsubcategoryId;
    }

    public function save()
    {
        $this->validate();
        $this->category = Category::create($this->all());
        return redirect()->route('admin.categories.index');
    }

    public function update()
    {
        $this->validate();
        $this->category->update(
            $this->all()
        );
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category-crud');
    }
}
