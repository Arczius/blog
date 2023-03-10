<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\FollowController;

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
    Route::get('/user/{id}', 'getUserBlogs');
    // Route::get('/users', 'getAllUsers');
  
    Route::delete('/destroy/{id}', 'destroy');
  
    Route::post('/store', 'store');
    Route::post('/edit/{id}', 'edit');
    Route::post('/info/{id}', 'getCurrentBlogInfo');
    Route::post('/file/{id}', 'getBlogImage');
    Route::post('/posts/{id}/comment', 'addComment');

    Route::delete('/destroy/{id}', 'destroy');
});

/* route for the categories */
Route::prefix('category')->controller(CategoriesController::class)->group(function () {
    Route::get('', 'getAllCategories');
    Route::get('/top', 'getTopCategories');
    Route::get('/amount/{amount}', 'getCategoriesByAmount');
});

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/currentUser', 'getCurrentUserInfo');
});

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/currentUser', 'getCurrentUserInfo');
});

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {

    Route::post('/currentUser', 'getCurrentUserInfo');

    /* updating the user */
    Route::post('/update', 'updateUserInformation');
    Route::post('/update/profile_picture', 'updateUserProfilePicture');
    Route::post('/update/profile_header', 'updateUserProfileHeader');
});

/* route for the profile */
Route::prefix('profile')->controller(UserController::class)->group(function () {
    Route::get('/user/{id}', 'getUserProfile');
});

/* route for the users */
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/currentUser', 'getCurrentUserInfo');
});

/* route for the followers */
Route::prefix('follow')->controller(FollowController::class)->group(function () {
    Route::get('/followers/single/{userid}' , 'getFollowersSinglePerson');
    Route::get('/following/single/{userid}', 'getFollowingSinglePerson');
});
