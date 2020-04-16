@extends('layouts.app')

@section('content')
 <div class="row">
     <div class="col-8">
   

    <div class="my-3">
        <h4>{{ $posts->count() }} Post(s)</h4>
    </div>

    @forelse ($posts as $post)
        <p>
            
            @if($post->created_at->diffInHours() < 1)
               <x-badge type="success">New</x-badge>
            @else
               <x-badge type="dark">Old</x-badge>
            @endif
            
            @if($post->image)
                <img src="{{ $post->image->url() }}" class="mt-3 img-fluid rounded" alt="">
            @endif

            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                  @if($post->trashed())
                    <del>
                        {{ $post->title }}
                    </del>
                  @else
                    {{ $post->title }}
                  @endif
                </a>
            </h3>

          

            <x-tags :tags="$post->tags"></x-tags>

            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

      

            <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>
            <x-updated :date="$post->updated_at">Updated </x-updated>

        @auth
            @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                class="btn btn-primary btn-sm">
                Edit
            </a>
            @endcan

            @cannot('delete', $post)
                <x-badge type="danger">You can't delete this post !</x-badge>
                    
              
            @endcannot
            
            @if(!$post->deleted_at)

              @can('delete', $post)
                <form method="POST" class="fm-inline"
                    action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Delete!" class="btn btn-sm btn-dark"/>
                </form>
              @endcan
            @else
              @can('restore', $post)
                <form method="POST" class="fm-inline"
                    action="{{ url('/posts/'.$post->id.'/restore') }}">
                    @csrf
                    @method('PATCH')

                    <input type="submit" value="Restore!" class="btn btn-sm btn-success"/>
                </form>
                @endcan
                @can('forceDelete', $post)
                <form method="POST" class="fm-inline"
                    action="{{ url('/posts/'.$post->id.'/forcedelete') }}">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Force delete!" class="btn btn-sm btn-danger"/>
                </form>
                @endcan
            @endif
        @endauth
            
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
   
     </div>
     <div class="col-4">
       @include('posts.sidebar')
     </div>
 </div>
   

@endsection('content')