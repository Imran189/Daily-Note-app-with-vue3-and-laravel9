<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NotetableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/register','register');
});

Route::controller(NotetableController::class)->group(function(){
    Route::get('/get_notes/{id}','get_notes');
    Route::get('/get_user_name/{id}','get_user_name');
    Route::post('/save_note/{id}','save_note');
});
