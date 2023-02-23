<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;


class PostsController extends Controller
{
    public function topPosts() : JsonResponse
    {
        
        return response()->json([]);
    }
}
