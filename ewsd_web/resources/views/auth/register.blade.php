@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-left-primary shadow">
                <div class="card-header">Register User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="username" class="form-control-label ">{{ __('Name') }}</label>

                                <div class="">
                                    <input id="username" type="text" class="form-control border-dark @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="fullname" class="form-control-label ">{{ __('Full Name') }}</label>

                                <div class="">
                                <input id="fullname" type="text" class="form-control border-dark @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('name') }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>


                                <div class="form-group">
                                <label for="email" class="form-control-label ">{{ __('E-Mail Address') }}</label>

                                <div class="">
                                <input id="email" type="email" class="form-control border-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="password" class="form-control-label ">{{ __('Password') }}</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control border-dark @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="form-control-label">{{ __('Confirm Password') }}</label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control border-dark" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image" class="form-control-label ">{{ __('Profile Image') }}</label>

                                        <input id="image" type="file" class="form-control border-dark @error('image') is-invalid @enderror" name="image" required >

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                
                                <div class="form-group row">
                                    <div class=" col-6">
                                       <a class="btn btn-warning btn-block" href="{{ route('users.index')}}">Back</a>
                                    </div>
                                    <div class=" col-6">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
