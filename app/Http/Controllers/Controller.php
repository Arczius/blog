<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function AuthorizeUser(String $token, String | Integer $userID)
    {
        $user = User::where('id', $userID)->pluck('token')->first();

        return Hash::check($token, $user->token);
    }

    protected function getUserData(String $token, String | Integer $userID) : array
    {
        return ($this->AuthorizeUser($token, $userID))
            ? [
                'user' => User::where('id', $userID)->pluck('id', 'handle', 'username')->first()
            ]
            : [
                'user' => false
            ];
    }
}
