<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path'];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function url() {
        return Storage::url($this->path);
    }
}
