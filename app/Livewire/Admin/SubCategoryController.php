<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Admin\SubcategoryForm;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class SubCategoryController extends Component
{
    Use WithPagination, WithoutUrlPagination, WithFileUploads;

    public SubcategoryForm $form;
    public $updateMode = false, $modalSubcategory = false;
    public $categories;
    public $search = '', $searchTerms;

    public function mount()
    {
        $this->categories = Category::all();
        
    }

    public function createSubcategory()
    {
        $this->modalSubcategory = true;
        $this->updateMode = false;
    }

    public function updatedModalSubcategory()
    {
        if ($this->updateMode == true) {
            $this->form->reset();
        }
    }

    public function save()
    {
        $this->form->store();
        $this->form->reset();
        session()->flash('message', 'Subcategoria creada  exitosamente.');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $this->form->subcategory_id = $id;
        $this->form->name = $subcategory->name;
        $this->form->description = $subcategory->description;
        $this->form->category_id = $subcategory->category_id;
       

        $this->form->images = $subcategory->images->pluck('path')->toArray();

        $this->updateMode = true;
        $this->modalSubcategory = true;
    }

    public function update()
    {
        $subcategory = Subcategory::find($this->form->subcategory_id);
        $this->form->update($subcategory);
        $this->form->reset();
        $this->modalSubcategory = false;
        $this->edit($subcategory->id); 
    }

    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->images()->each(function ($image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        });

        $subcategory->delete();
        session()->flash('message', 'SubCategoria eliminada exitosamente.');
    }

    public function removeImage($path)
    {
        $this->form->images = array_filter($this->form->images, fn ($image) => $image !== $path);
        Storage::delete('public/' . $path);
        Image::where('path', $path)->delete();
    }

    public function searchEnter(){
        $this->searchTerms = array_filter(explode(' ', $this->search));
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $subcategories = Subcategory::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $subcategories->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            }
        }

        $subcategories = $subcategories->paginate(5);
    
        return view('livewire.admin.sub-category-controller', [
            'subcategories' => $subcategories,
        ]);
    }
}
