@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  
                <h1>{{ __('Welcome') }}</h1>
              
                
                <p>{{ __('messages.example_with_value', ['name' => 'Mohamed']) }}</p>
                <p>@lang('messages.example_with_value', ['name' => 'Walid'])</p>

                <p>{{ trans_choice('messages.plural', 0) }}</p>
                <p>{{ trans_choice('messages.plural', 1) }}</p>
                <p>{{ trans_choice('messages.plural', 20) }}</p>

                <h4>{{ __('welcome') }}</h4>
                <h4>{{ __('example_with_value', ['name' => 'Mohamed']) }}</h4>

                <p>{{ trans_choice('plural', 0) }}</p>
                <p>{{ trans_choice('plural', 1) }}</p>
                <p>{{ trans_choice('plural', 20) }}</p>

                    @can('secret.page')
                     <p><a href="/secret">administation</a></p>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
