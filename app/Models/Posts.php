<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comments;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'picture',
        'timestamp',
    ];

    // a post belongs to one user
    public function author(){
        return $this->belongsTo(User::class);
    }

    // a post can have multiple comments
    public function postComments(){
        return $this->belongsToMany(Comments::class, 'posts_comments', 'post_id', 'comment_id');
    }

    // a post can have one category
    public function postCategory(){
        return $this->hasOne(Category::class);
    }
}
