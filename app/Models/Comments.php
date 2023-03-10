<?php

namespace App\Models;

use App\Models\User;
use App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'posts_id'
    ];

    // a comment belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // a comment belongs to one post
    public function post(){
        return $this->belongsTo(Posts::class);
    }
}
