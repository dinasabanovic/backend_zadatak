<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MealController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
Route::apiResource('meals', MealController::class);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('tags', [TagController::class, 'index']);
Route::get('ingredients', [IngredientController::class, 'index']);