<?php

use App\Livewire\Welcome;
use App\Livewire\Products;

use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');

Route::get('/products', Products\Index::class)->name('products.index');
