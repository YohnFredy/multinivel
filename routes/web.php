<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Office\IndexController;
use App\Http\Controllers\PruebasController;
use App\Livewire\Membership;
use App\Livewire\Office\Tree\Binary;
use App\Livewire\Office\Tree\Unilevel;
use App\Livewire\Prueba;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('menu', function () {
    return view('menu-admin');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('pruebas', [PruebasController::class, 'index'])->name('pruebas');


    Route::get('office/index', [IndexController::class, 'index'])->name('office.index');
    Route::get('tree/binary', Binary::class)->name('tree.binary');
    Route::get('tree/unilevel', Unilevel::class)->name('tree.unilevel');

    Route::get('admin/index', [AdminIndexController::class, 'index'])->name('admin.index');
});

Route::get('register/{sponsor}/{position}', Membership::class);
