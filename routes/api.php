<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\ActivationController;/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('/auth/activate/{token}', [ActivationController::class, 'activate']);
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->resource('tasks', TaskController::class);
Route::middleware('auth:sanctum')->resource('users', UserController::class);


#Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
#    return $request->user();
#});


