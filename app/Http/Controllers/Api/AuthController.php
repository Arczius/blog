<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{
    public function createUser(Request $request) : JsonResponse
    {
        try {

            $validatedUser = Validator::make($request->all(),
            [
                'username'          =>  'required|string|max:255',
                'handle'            =>  'required|string|unique:users,handle|max:255',
                'email'             =>  'email|required|unique:users,email|max:255',
                'password'          =>  'required|string|max:255',
                'about_me'          =>  'nullable|string|max:255',
            ]);

            if($validatedUser->fails()){
                return response()->json([
                    'status' => 'validation failed',
                    'errors' => $validatedUser->errors()
                ], 400);
            }

            $user = User::create([
                'username'  =>  $request->username,
                'handle'    =>  $request->handle,
                'email'     =>  $request->email,
                'password'  =>  Hash::make($request->password),
                'about_me'  =>  $request->about_me,
            ]);

            return response()->json([
                'status' => 'success',
                'token' => $user->createToken($request->handle)->plainTextToken
            ]);

        }

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $request) : JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'handle' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['handle', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Handle & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('handle', $request->handle)->first();

            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken($user->handle)->plainTextToken,
                'current_token' => $user->tokens()->first(),
            ], 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function authorizeUser(Request $request)
    {
        $user = $request->user;

        $authUser = Auth::user();


        $data = [
            'user' => $user,
            'auth_user' => $authUser
        ];

        return response()->json($data);
    }
}
