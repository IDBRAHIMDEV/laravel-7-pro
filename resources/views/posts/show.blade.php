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
    
        <x-comment-form :action="route('posts.comments.store', ['post' => $post->id])"></x-comment-form>

        <hr>
   
       <x-comment-list :comments="$post->comments"></x-comment-list>
      </div>
      <div class="col-4">
        @include('posts.sidebar')
      </div>
  </div>
  
@endsection('content')