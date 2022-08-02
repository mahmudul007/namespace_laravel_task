<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TestController;
use  App\Http\Controllers\authenticateController;


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
Route::get('/test',[TestController::class,'test']);
Route::post('/short',[TestController::class,'linkStore']);
Route::get('/shortlInk/{shortlink}',[TestController::class,'shortlInk']);
Route::get('/all',[TestController::class,'all']);
Route::post ('/register',[authenticateController::class,'Register']);
Route::post ('/Login',[authenticateController::class,'Login']);
