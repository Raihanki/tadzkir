<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;

Route::post('/login', Auth\LoginController::class);
Route::post('/register', Auth\RegisterController::class);
Route::post('/logout', Auth\LogoutController::class);

Route::get('/user', fn (Request $request) => $request->user());

Route::apiResource('menus', \App\Http\Controllers\Menu\MenuController::class)->parameters([
    'menus' => 'slug'
]);

Route::get('info_menus', [\App\Http\Controllers\Menu\InfoMenuController::class, 'index']);
Route::get('info_menus/{menu:slug}/show', [\App\Http\Controllers\Menu\InfoMenuController::class, 'show']);
Route::post('info_menus/{menu:slug}', [\App\Http\Controllers\Menu\InfoMenuController::class, 'store']);
Route::delete('info_menus/{infoMenu:id}/delete', [\App\Http\Controllers\Menu\InfoMenuController::class, 'delete']);

//Dzikir
Route::get('getAllDzikir', [\App\Http\Controllers\Dzikir\DzikirController::class, 'index']);
Route::get('showDzikirByCategory/{category:slug}', [\App\Http\Controllers\Dzikir\DzikirController::class, 'showByCategory']);
Route::get('showDzikirByMenu/{menu:slug}', [\App\Http\Controllers\Dzikir\DzikirController::class, 'showByMenu']);
Route::post('createNewDzikir/{menu:slug}', [\App\Http\Controllers\Dzikir\DzikirController::class, 'createNewDzikir']);
Route::delete('deleteDzikir/{id}', [\App\Http\Controllers\Dzikir\DzikirController::class, 'deleteDzikir']);
