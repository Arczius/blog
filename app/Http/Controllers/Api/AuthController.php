<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            ]);

            return response()->json([
                'status' => 'success',
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

            $validatedCredentials = Validator::make($request->all(),
            [
                'handle' => 'required',
                'password' => 'required',
            ]);

            if($validatedCredentials->fails()){
                return response()->json([
                    'status' => 'validation failed',
                    'errors' => $validatedCredentials->errors()
                ], 400);
            }

            $credentials = [
                'handle' => $request->handle,
                'password' => $request->password,
            ];

            if(Auth::attempt($credentials)) {
                $user = Auth::user();
                $randomToken = Str::random(64);

                User::where('id', $user->id)->update([
                    'token' => Hash::make($randomToken),
                ]);

                return response()->json([
                    'status' => 'success',
                    'id' => $user->id,
                    'token' => $randomToken,
                ]);
            }

            return response()->json([
                'status' => 'failed'
            ]);
        }

        catch (\Throwable $th) {
            return response()->json([
                'status' => 'server error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function currentUser(Request $request)
    {
        return response()->json(
            [
                'authorized' => $this->getUserData($request->token, $request->userID)
            ]
        );
    }
}
