<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comments;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'description',
        'picture',
        'timestamp',
    ];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function postComments(){
        return $this->hasMany(Comment::class);
    }

    public function postCategory(){
        return $this->hasOne(Category::class);
    }
}
