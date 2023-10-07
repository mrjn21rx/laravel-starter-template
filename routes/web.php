<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'app', 'as' => 'app.'], function () {
    Route::get('/dashboard', function () {
        return view('pages.app.dashboard');
    })->name('home');
    Route::get('/permissions', PermissionController::class)
        ->name('permissions')->middleware('permission:permissions.index');
    Route::resource('/roles', RoleController::class)->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
});

// Route::prefix('app')->group(function () {

//     Route::group(['middleware' => 'auth'], function () {
//     });
// });

// Route::middleware(['auth'])->group(function () {

//     Route::get('/permissions', 'App\Http\Controllers\Apps\PermissionController@index')
//         ->name('app.permissions')->middleware('permission:permissions.index');
// });
