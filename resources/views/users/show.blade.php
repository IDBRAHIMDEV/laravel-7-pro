@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h5>Avatar user</h5>
            <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="img-thumbnail avatar">
                @can('update', $user)
                 <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm">Edit</a>
                @endcan
        </div>
        <div class="col-md-8">
            <h3>{{ $user->name }}</h3>
            <x-comment-form :action="route('users.comments.store', ['user' => $user->id])"></x-comment-form>
            <hr>
            
            <x-comment-list :comments="$user->comments"></x-comment-list>
        </div>
    </div>


@endsection