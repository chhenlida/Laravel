<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

// Protect user route with authentication
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Category Routes
Route::controller(CategoryController::class)->prefix('categories')->group(function(){
    Route::get('/', 'index'); // Use index method to get categories
    Route::post('/', 'store');
    Route::get('/{category}', 'show');
    Route::patch('/{category}', 'update');
    Route::delete('/{category}', 'destroy');
});
