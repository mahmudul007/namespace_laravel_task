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

Route::post('/short',[TestController::class,'linkStore']);
Route::get('/shortlInk/{shortlink}',[TestController::class,'shortlInk']);
Route::get('/all',[TestController::class,'all']);

//authentication
Route::post ('/register',[authenticateController::class,'Register']);
Route::post ('/login',[authenticateController::class,'Login']);
Route::put('/logout',[authenticateController::class,'Logout']);

//testing route

Route::get('/ip',[authenticateController::class,'Ip'])->middleware ('throttle:ip_address');


Route::get('/test',[TestController::class,'test']);