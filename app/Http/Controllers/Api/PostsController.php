<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Models\Posts;

class PostsController extends Controller
{
    public function topPosts(String $amount = null) : JsonResponse
    {
        // $posts = ($amount === null)
        //     ?  Posts::withCount('postComments')->orderBy('post_comments_count', 'desc')->get()
        //         : Posts::withCount('postComments')->orderBy('post_comments_count', 'desc')->limit($amount)->get();

        // // $users = ($amount === null)
        // //     ? true
        // //         : false
        // // ;

        // $users = [];

        // foreach($posts as $post){
        //     array_push($users, $post->author);
        // }

        // return response()->json([
        //     'posts' => $posts,
        //     'users' => $users,
        // ]);
        return response()->json();
    }
}
