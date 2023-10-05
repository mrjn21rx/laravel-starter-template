<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apps\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'app', 'as' => 'app.'], function () {
    Route::get('/permissions', PermissionController::class)
        ->name('permissions')->middleware('permission:permissions.index');
    Route::get('/dashboard', function () {
        return view('pages.app.dashboard', ['type_menu' => '']);
    })->name('home');
});

// Route::prefix('app')->group(function () {

//     Route::group(['middleware' => 'auth'], function () {
//     });
// });

// Route::middleware(['auth'])->group(function () {

//     Route::get('/permissions', 'App\Http\Controllers\Apps\PermissionController@index')
//         ->name('app.permissions')->middleware('permission:permissions.index');
// });
