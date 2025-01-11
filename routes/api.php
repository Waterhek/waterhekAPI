<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoTaskController;
use App\Http\Controllers\ClashOfClansController;
use App\Http\Controllers\EpicGameController;
use App\Http\Controllers\API\SoccerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/todo', [TodoTaskController::class, 'index']);
Route::post('/todo/create', [TodoTaskController::class, 'store']);
Route::get('/todo/show', [TodoTaskController::class, 'show']);
Route::get('/coc/player/{tag}', [ClashOfClansController::class, 'getPlayer']);

Route::get('/epic/freegame', [EpicGameController::class, 'getFreeGames']);

Route::get('/soccer/fixtures', [SoccerController::class, 'fixtures']);
