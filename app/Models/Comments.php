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
        'Comment',
    ];

    // a comment belongs to one user
    public function author(){
        return $this->belongsTo(User::class);
    }

    // a comment belongs to one post
    public function post(){
        return $this->belongsTo(Posts::class);
    }
}
