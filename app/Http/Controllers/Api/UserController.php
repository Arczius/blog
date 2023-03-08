<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\JsonResponse;

use App\Models\User;

class UserController extends Controller
{
    public function getCurrentUserInfo(Request $request) : JsonResponse
    {

        return ($this->AuthorizeUser($request->token, $request->userID))
            ? response()->json(
                [
                    'user' => User::select('id', 'username', 'about_me', 'email', 'profile_header', 'profile_picture')->where('id', $request->userID)->first(),
                ]
            )
                : response()->json(
                    [
                        'Unauthorized' => true,
                    ],
                401);
    }

    public function updateUserInformation(Request $request) : JsonResponse
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


            if(!$this->AuthorizeUser($request->token, $id)){
                return response()->json([
                    'status' => 'unauthorized to do this action'
                ], 401);
            }

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

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function updateUserProfilePicture(Request $request)
    {
        try{
            $validated = Validator::make($request->all(),
                [
                    'image' => 'required|mimes:jpg,png,webp,svg,gif|max:4096'
                ]
            );

            if($validated->fails()) {
                return response()->json([
                    'status' => 'validation failed',
                    'errors' => $validated->errors()
                ], 400);
            }

            if(!$this->AuthorizeUser($request->token, $request->userID)){
                return response()->json([
                    'status' => 'unauthorized to do this action'
                ], 401);
            }

            $user = User::where('id', $request->userID)->first();


            // deleting the old picture
            if($user->profile_picture !== null) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // generating the new picture
            $image = $request->file('image');

            $filename = $request->userID . "_profile-picture." . $image->extension();

            $image->storeAs(
                'public/profile_pictures',
                $filename
            );

            // putting the new picture in the database
            User::where('id', $request->userID)->update(
                [
                    'profile_picture' => 'profile_pictures/' . $filename
                ]
            );

            return response()->json([
                'status' => 'success'
            ]);
        }

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function updateUserProfileHeader(Request $request)
    {

        try{
            $validated = Validator::make($request->all(),
                [
                    'image' => 'required|mimes:jpg,png,webp,svg,gif|max:4096'
                ]
            );

            if($validated->fails()) {
                return response()->json([
                    'status' => 'validation failed',
                    'errors' => $validated->errors()
                ], 400);
            }

            if(!$this->AuthorizeUser($request->token, $request->userID)){
                return response()->json([
                    'status' => 'unauthorized to do this action'
                ], 401);
            }

            $user = User::where('id', $request->userID)->first();


            // deleting the old picture
            if($user->profile_header !== null) {
                Storage::disk('public')->delete($user->profile_header);
            }

            // generating the new picture
            $image = $request->file('image');

            $filename = $request->userID . "_profile-header." . $image->extension();

            $image->storeAs(
                'public/profile_headers',
                $filename
            );

            // putting the new picture in the database
            User::where('id', $request->userID)->update(
                [
                    'profile_header' => 'profile_headers/' . $filename
                ]
            );

            return response()->json([
                'status' => 'success'
            ]);
        }

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
