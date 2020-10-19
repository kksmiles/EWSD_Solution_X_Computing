@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('fail'))
                    <div class="alert alert-error" role="alert">
                        {{ session('fail') }}
                    </div>
                    @elseif (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            {{ __('You are logged in!') }}
                        </div>  
                    @endif  
                    <div>
                        EWSD HOME    
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
