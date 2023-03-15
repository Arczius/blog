<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Models\Posts;

class PostsController extends Controller
{
    public function topPosts(String $amount = null) : JsonResponse
    {
        $posts = ($amount === null)
            ?  Posts::with(['user' => function ($query) {
                $query->select([
                    'id',
                    'handle',
                    'profile_picture'
                ]);
            }])->withCount('Comments')->orderBy('comments_count', 'desc')->get()
                : Posts::with(['user' => function ($query) {
                    $query->select([
                        'id',
                        'handle',
                        'profile_picture'
                    ]);
                }])->withCount('Comments')->orderBy('comments_count', 'desc')->limit($amount)->get();


        return response()->json([
            'posts' => $posts,
        ]);
    }
}
