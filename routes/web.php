<?php

use App\Livewire\Products;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');

Route::get('/products', Products\Index::class)->name('products.index');
