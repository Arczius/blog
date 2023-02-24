<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'createUser');
    Route::post('/login', 'loginUser');
    Route::post('', 'authorizeUser');
});

Route::prefix('blog')->controller(BlogController::class)->group(function () {
    Route::post('/store', 'store');
    Route::post('/file/{id}', 'getBlogImage');
});
