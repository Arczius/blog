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
                    'user' => User::select('username', 'about_me', 'email', 'profile_header', 'profile_picture')->where('id', $request->userID)->first(),
                ]
            )
                : response()->json(
                    [
                        'Unauthorized' => true,
                    ],
                401);
    }

    public function updateUserInformation(Request $request)
    {
        try {

            $id = $request->userID;
            $validatedUser = Validator::make($request->all(),
                [
                    'username' => 'required|string|max:255',
                    'about_me' => 'required|string|max:255',
                    'email' => 'email|required|unique:users,email,' . $id . '|max:255',
                ]
            );

            if($validatedUser->fails()) {
                return response()->json([
                    'status' => 'validation failed',
                    'errors' => $validatedUser->errors()
                ], 400);
            }


            if($this->AuthorizeUser($request->token, $id)){

                User::where('id', $id)->update(
                    [
                        'username' => $request->username,
                        'about_me' => $request->about_me,
                        'email' => $request->email,
                    ]
                );

                return response()->json([
                    'status' => 'success'
                ]);
            }
            else {

            }

        }

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function updateUserProfilePicture(Request $request)
    {

    }

    public function updateUserProfileHeader(Request $request)
    {

    }
}
