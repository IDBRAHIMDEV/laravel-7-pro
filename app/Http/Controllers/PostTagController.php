<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($id) {

           $tag = Tag::find($id);
           

           return view('posts.index', [
               'posts' => $tag->posts()->postWithUserCommentsTags()->get(),

           ]);

    }
}
