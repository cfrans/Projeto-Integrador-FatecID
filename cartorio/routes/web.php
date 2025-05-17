<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Olá, Mundo!";
});

Route::get('/protocolos', function () {
    return view('protocolos.index');
})->name('protocolos.index');