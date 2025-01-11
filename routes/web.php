<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\APIController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/api', [APIController::class, 'index']);
Route::get('/admin/api/create', [APIController::class, 'create'])->name('admin.api.create');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/', [APIController::class, 'index'])->name('index');
        Route::get('/create', [APIController::class, 'create'])->name('create');
        Route::post('/create', [APIController::class, 'store'])->name('store');
    });
    
});