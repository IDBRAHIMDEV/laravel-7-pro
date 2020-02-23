<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function articles() {
        return $this->hasMany(Post::class);
    }
}
