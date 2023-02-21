<?php

namespace App\Models;

use App\Models\Posts;
use App\Models\Comments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'username',
        'handle',
        'email',
        'password',
        'about_me',
        'profile_picture',
        'profile_header',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // a user can have multiple posts
    public function posts(){
        return $this->hasMany(Posts::class);
    }

    // a user can have multiple comments
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
