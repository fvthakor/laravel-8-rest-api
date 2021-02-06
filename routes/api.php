<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/blog/create', [BlogController::class, 'create']);
Route::get('/blog/show/{id}', [BlogController::class, 'show']);
Route::post('/blog/update/{id}', [BlogController::class, 'update']);
Route::get('/blog/delete/{id}', [BlogController::class, 'destroy']);




