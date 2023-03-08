<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\User;

class UserController extends Controller
{
    public function getCurrentUserInfo(Request $request)
    {

        return ($this->AuthorizeUser($request->token, $request->userID))
            ? response()->json(
                [
                    'user' => User::select('id')->where('id', $request->userID)->first(),
                ]
            )
            : response()->json(
                [
                    'Unauthorized' => true,
                ],
            401);
    }

    /**
    * get the profile for an existing user
    *
    * @return 
    */
    public function getUserProfile(String $id) : JsonResponse
    {
        return response()->json([
            'users' => User::where('id', $id)->first(),
        ]);
    }
}