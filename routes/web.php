<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('marcas', MarcaController::class);
    Route::resource('productos', ProductosController::class);
});

Route::resource('notas', NotaController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
