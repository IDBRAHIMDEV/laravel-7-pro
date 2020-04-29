
@if(session()->has('status'))
   <div class="alert alert-info" role="alert">
       <strong>Info: </strong> {{ session()->get('status') }}
   </div>
@endif