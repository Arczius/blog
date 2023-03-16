<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Following;

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

    public function follow(Request $request) : JsonResponse
    {
        $action = $request->action;
        if($this->AuthorizeUser($request->token, $request->userid))
        {
            switch($action){
                case 'follow': 
                    if(
                        $request->userid !== $request->follow_user_id
                        &&
                        !Following::where([
                            'user_id' => $request->userid,
                            'follow_id'=> $request->follow_user_id
                        ])->first()
                    )
                    {
                        Following::create([
                            'user_id' => $request->userid,
                            'follow_id' => $request->follow_user_id
                        ]);

                        return response()->json([
                            'status' => 'success',
                            'following' => true,
                        ]);
                    }
                    break;
                
                case 'unfollow':
                    Following::where([
                        'user_id' => $request->userid,
                        'follow_id' => $request->follow_user_id
                    ])->delete();
                    return response()->json([
                        'status' => 'success',
                        'following' => false,
                    ]);
                    break;
            }        

            return response()->json([
                'status' => 'failed, bad request',
            ], 403);
        }


        return response()->json([
            'status' => 'failed, not authorized',
        ], 401);
    }

    public function userFollows(Request $request) : JsonResponse
    {
        $current_user = $request->current_user_id;
        $follow_user = $request->follow_user_id;


        return response()->json([
            'following' =>  (Following::where([
                            'user_id' => $current_user,
                            'follow_id' => $follow_user
                        ])->first() !== null)
        ]);
    }
}