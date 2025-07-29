<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/search', [SearchController::class, 'index']);
Route::post('/search', [SearchController::class, 'search']);