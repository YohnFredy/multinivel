<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BrandCotroller extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $updateMode = false, $modalBrand = false;
    public $search = '', $searchTerms;

    public $brand_id = '';

    #[Validate('required|string|max:100|min:3')]
    public $name = '';
    public $slug = '';

    public function createBrand()
    {
        $this->modalBrand = true;
        $this->updateMode = false;
    }

    public function updatedModalBrand()
    {
        if ($this->updateMode == true) {
            $this->reset();
        }
    }

    public function save()
    {
        $this->validate();
        Brand::create($this->all());
        $this->reset();
        session()->flash('message', 'Marca creada exitosamente.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brand_id = $id;
        $this->name = $brand->name;

        $this->updateMode = true;
        $this->modalBrand = true;
    }

    public function update()
    {
        $brand = Brand::find($this->brand_id);

        $this->validate();
        $brand->update(
            $this->all()
        );

        $this->reset();
        $this->modalBrand = false;
        $this->edit($brand->id);
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();
        session()->flash('message', 'Marca eliminada exitosamente.');
    }

    
    public function searchEnter()
    {
        $this->searchTerms = array_filter(explode(' ', $this->search));
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $brands = Brand::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $brands->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%');
                });
            }
        }

        $brands = $brands->paginate(5);

        return view('livewire.admin.brand-cotroller', [
            'brands' => $brands,
        ]);
    }
}
