<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\PostsController;

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

Route::prefix('category')->controller(CategoriesController::class)->group(function () {
    Route::get('', 'getAllCategories');
    Route::get('/top', 'getTopCategories');
    Route::get('/amount/{amount}', 'getCategoriesByAmount');
});

Route::prefix('post')->controller(PostsController::class)->group(function () {
    Route::get('/top', 'topPosts');
});
