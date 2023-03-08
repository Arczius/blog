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

    /**
     * a method for checking if the current user is logged-in or not
     *
     * @param String $token the token of the currently logged-in user
     * @param String|Integer $userID the id of the currently logged-in user
     * @returns Boolean
     */
    protected function AuthorizeUser(String $token, String | Integer $userID) : bool
    {
        $userToken = User::select('token')->where('id', $userID)->first();

        return Hash::check($token, $userToken->token);
    }

    /**
     * a method for checking if the current user is logged-in and returning some userdata
     *
     * @param String $token the token of the currently logged-in user
     * @param String|Integer $userID the id of the currently logged-in user
     * @returns array
     */
    protected function getUserData(String $token, String | Integer $userID) : array
    {
        return ($this->AuthorizeUser($token, $userID))
            ? [
                'user' => User::select('id', 'handle', 'username')->where('id', $userID)->first()
            ]
            : [
                'user' => false
            ];
    }
}

