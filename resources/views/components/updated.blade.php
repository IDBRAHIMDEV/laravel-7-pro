<div class="text-muted">
   {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date }} {{ isset($name) ? ', by '.$name : null }} 
</div>