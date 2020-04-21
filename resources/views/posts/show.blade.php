@extends('layouts.app')

@section('content')

  <div class="row">
      <div class="col-8">
        <h1>{{ $post->title }}</h1>
      
        @if($post->image)
            <img src="{{ $post->image->url() }}" class="mt-3 img-fluid rounded" alt="">
        @endif

        <p>{{ $post->content }}</p>
    
        <x-tags :tags="$post->tags"></x-tags>
    
        <p>Added {{ $post->created_at->diffForHumans() }}</p>
    
        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5 )
            <strong>New!</strong>
        @endif
    
        <h4>Comments</h4>
    
        @include('comments.form', ['id' => $post->id])


        <hr>

        @forelse($post->comments as $comment)
            <p>
                {{ $comment->content }}
            </p>
            
            <p class="text-muted">
              <x-updated :date="$comment->created_at" :name="$comment->user->name" :user-id="$comment->user->id"></x-updated>
            </p>
        @empty
            <p>No comments yet!</p>
        @endforelse
      </div>
      <div class="col-4">
        @include('posts.sidebar')
      </div>
  </div>
  
@endsection('content')