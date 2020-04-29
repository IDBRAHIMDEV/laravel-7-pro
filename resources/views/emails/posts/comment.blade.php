
<p>
    SomeOne has comment you Post 
<a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">{{ $comment->commentable->title }}</a>
</p>

<p>

<a href="{{ route('users.show', ['user' => $comment->user->id]) }}">{{ $comment->user->name }}</a>, Said : 
</p>

<p>
    {{ $comment->content }}.
</p>