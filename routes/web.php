<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/app/dashboard', function () {
        return view('pages.app.dashboard', ['type_menu' => '']);
    })->name('home');
});
