<div class="text-muted">
   {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date }} 
   {!! isset($name) ? ', by <a href='. route('users.show', ['user' => $userId]) .'>'.$name . '</a>' : null !!} 
</div>