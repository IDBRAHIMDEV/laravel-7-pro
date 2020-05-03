<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as MyCommentPosted;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Mail\CommentedPostMarkdown;
use App\Mail\CommentPosted;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(StoreComment $request, Post $post) {
        
        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        event(new MyCommentPosted($comment));

       // Mail::to($post->user->email)->send(new CommentedPostMarkdown($comment));

       //    $when = now()->addMinutes(1);
       //    Mail::to($post->user->email)->later($when, new CommentedPostMarkdown($comment));

        return redirect()->back();
    }
}
