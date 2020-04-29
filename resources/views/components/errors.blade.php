@if($errors->any())
<div class="alert alert-{{ $myClass }}">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif