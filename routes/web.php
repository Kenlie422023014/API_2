<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InteriorController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/interior', function(){
    return view('pages.plp');
})->name('plp');

Route::get('/interior/{i}', function (){
    return view('pages.pdp');
})->name('pdp');
