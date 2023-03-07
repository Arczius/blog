<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\BlogController;
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

/* route for the auth */
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'createUser');
    Route::post('/login', 'loginUser');
    Route::post('', 'currentUser');
});

/* route for the blogs */
Route::prefix('blog')->controller(BlogController::class)->group(function () {
    Route::get('', 'getAllBlogs');
    Route::post('/store', 'store');
    Route::delete('/destroy/{id}', 'destroy');
    Route::post('/edit/{id}', 'edit');
    Route::post('/file/{id}', 'getBlogImage');
});

/* route for the categories */
Route::prefix('category')->controller(CategoriesController::class)->group(function () {
    Route::get('', 'getAllCategories');
    Route::get('/top', 'getTopCategories');
    Route::get('/amount/{amount}', 'getCategoriesByAmount');

});

/* route for the posts */
// Route::prefix('post')->controller(PostsController::class)->group(function () {
//     Route::get('/top', 'topPosts');
//     Route::get('/top/{amount}', 'topPosts');
// });

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/currentUser', 'getCurrentUserInfo');
});

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/currentUser', 'getCurrentUserInfo');
});
