<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;

class FollowController extends Controller
{
    public function getFollowersSinglePerson($userid) : JsonResponse
    {
        $followers = User::where('id', $userid)->with('followers')->first()->followers;

        return response()->json([
            'followers' => $followers,
            'follower_amount' => count($followers),
        ]);
    }

    public function getFollowingSinglePerson($userid) : JsonResponse
    {
        $following = User::where('id', $userid)->with('following')->first()->following;

        return response()->json([
            'following' => $following,
            'following_amount' => count($following),
        ]);
    }
}
