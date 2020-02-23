<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function category() {
        return $this->belongsTo(Category::class);
    }
}
