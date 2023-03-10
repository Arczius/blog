<?php

namespace App\Models;

use App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture',
    ];

    // a category can have multiple posts
    public function post(){
        return $this->belongsToMany(Posts::class, 'categories_posts', 'category_id', 'post_id');
    }
}
