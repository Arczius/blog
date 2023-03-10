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
        'token',
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

    // a user can follow multiple people
    public function following(){
        return $this->belongsToMany(User::class, 'following', 'user_id', 'follow_id');
    }

    // a user can have multiple followers
    public function followers(){
        return $this->belongsToMany(User::class, 'following', 'follow_id', 'user_id');
    }
    // a user can have multiple posts
    public function posts(){
        return $this->hasMany(Posts::class);
    }

    // a user can have multiple comments
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
