<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Office\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestingAndCreatingDataController;
use App\Http\Controllers\WebhookController;
use App\Livewire\Admin\BrandCotroller;
use App\Livewire\Admin\CategoryCrud;
use App\Livewire\Admin\CategoryIndex;
use App\Livewire\Admin\ProductCrud;
use App\Livewire\Admin\ProductIndex;
use App\Livewire\Cart;
use App\Livewire\CreateOrder;
use App\Livewire\Membership;
use App\Livewire\Office\Tree\Binary;
use App\Livewire\Office\Tree\Unilevel;
use App\Livewire\Products;
use App\Livewire\Prueba;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;


Route::get('/', Products::class)->name('products');

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lange');

Route::get('testing_and_creating_data', [TestingAndCreatingDataController::class, 'createData'])->name('TestingAndCreatingData');


Route::get('producto/{product}', ShowProduct::class)->name('product.show');
Route::get('carrito', Cart::class)->name('cart');

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
    Route::get('admin/categorias', CategoryIndex::class)->name('admin.categories.index');
    Route::get('admin/categories/create', CategoryCrud::class)->name('admin.categories.create');
    Route::get('admin/categories/{category}/edit', CategoryCrud::class)->name('admin.categories.edit');
    Route::get('admin/Marca', BrandCotroller::class)->name('admin.brand');

    Route::get('/admin/products', ProductIndex::class)->name('admin.products.index');
    Route::get('/admin/products/create', ProductCrud::class)->name('admin.products.create');  
    Route::get('/admin/products/{product}/edit', ProductCrud::class)->name('admin.products.edit');
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::get('orders/bold/respuesta', [OrderController::class, 'boldResponsePayment'])->name('orders.bold');
});

Route::post('webhook/bold/payment-status', [WebhookController::class, 'handleBoldWebhook']); 

Route::get('register/{sponsor}/{position}', Membership::class)->name('membership');
Route::get('prueba', Prueba::class);
