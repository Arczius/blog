<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\User;

class UserController extends Controller
{
    /**
    * get one existing user
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