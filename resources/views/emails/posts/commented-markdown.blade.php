@component('mail::message')
# Introduction

SomeOne has comment you Post 

[Bright Coding](https://brightcoding.teachable.com)

The body of your message.

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id]) ])
Read More
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id]) ])
    {{ $comment->user->name }} Profile
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
