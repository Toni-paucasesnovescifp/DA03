<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 

// Ruta per comprovar l'usuari autenticat 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoints 1 i 2: Registre i Login (Públics)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


use App\Http\Controllers\ArticleController;

// Rutes Públiques
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

// Rutes Privades (Requereixen Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
});

