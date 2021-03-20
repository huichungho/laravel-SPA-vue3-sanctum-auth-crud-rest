<?php

// use Illuminate\Http\Request;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'customers', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('add', [CustomerController::class, 'add']);
    Route::get('edit/{id}', [CustomerController::class, 'edit']);
    Route::post('update/{id}', [CustomerController::class, 'update']);
    Route::delete('delete/{id}', [CustomerController::class, 'delete']);
});