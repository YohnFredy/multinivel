<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Admin\CategoryForm;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CategoryController extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads; 
    public CategoryForm $form;

    public $updateMode = false, $modalCategory = false;
    public $search = '', $searchTerms;

    
    public function createCategory()
    {
        $this->modalCategory = true;
        $this->updateMode = false;
    }

    public function updatedModalCategory()
    {
        if ($this->updateMode == true) {
            $this->form->reset();
        }
    }

    public function save()
    {
        $this->form->store();
        $this->form->reset();
        session()->flash('message', 'Category creada exitosamente.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->form->category_id = $id;
        $this->form->name = $category->name;
        $this->form->description = $category->description;
       
        $this->updateMode = true;
        $this->modalCategory = true;
    }

    public function update()
    {
        $category = Category::find($this->form->category_id);
        $this->form->update($category);
        $this->form->reset();
        $this->modalCategory = false;
        $this->edit($category->id); 
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        $category->delete();
        session()->flash('message', 'Categoria eliminada exitosamente.');
    }


    public function searchEnter(){
        $this->searchTerms = array_filter(explode(' ', $this->search));
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $categories = Category::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $categories->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            }
        }

        $categories = $categories->paginate(5);
        return view('livewire.admin.category-controller', [
            'categories' => $categories,
        ]);
    }
}
