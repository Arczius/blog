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
        'coverFile',
        'file'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y', 
        'updated_at' => 'datetime:d-m-Y',
    ];

    // a post belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // a post can have multiple comments
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
