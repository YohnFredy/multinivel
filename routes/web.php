<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Office\IndexController;
use App\Livewire\Admin\BrandCotroller;
use App\Livewire\Admin\CategoryController;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\ProductIndex;
use App\Livewire\Membership;
use App\Livewire\Office\Tree\Binary;
use App\Livewire\Office\Tree\Unilevel;
use App\Livewire\Products;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('productos', Products::class)->name('products');
Route::get('producto/{product}', ShowProduct::class)->name('product.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('office/index', [IndexController::class, 'index'])->name('office.index');
    Route::get('tree/binary', Binary::class)->name('tree.binary');
    Route::get('tree/unilevel', Unilevel::class)->name('tree.unilevel');

    Route::get('admin/index', [AdminIndexController::class, 'index'])->name('admin.index');
    Route::get('admin/categorias', CategoryController::class)->name('admin.categories');
    Route::get('admin/Marca', BrandCotroller::class)->name('admin.brand');

    Route::get('/admin/products', ProductIndex::class)->name('admin.products.index');
    Route::get('/admin/products/create', ProductForm::class)->name('admin.products.create');
    Route::get('/admin/products/{product}/edit', ProductForm::class)->name('admin.products.edit');

});

Route::get('register/{sponsor}/{position}', Membership::class);
