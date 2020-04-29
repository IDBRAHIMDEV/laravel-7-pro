<x-card title="Most Post Commented">
    @foreach($mostCommented as $post)
        <li class="list-group-item">
            <a href="">{{ $post->title }}</a>
            <p><span class="badge badge-success">{{ $post->comments_count }}</span></p>
        </li>
    @endforeach
</x-card>

<x-card 
    title="Most Users" 
    text="Most Users post written" 
    :items="collect($mostUsersActive)->pluck('name')">
</x-card>

<x-card 
    title="Most Users Active" 
    text="Most Users Active in last month" 
    :items="collect($mostUserActiveInLastMonth)->pluck('name')">
</x-card>