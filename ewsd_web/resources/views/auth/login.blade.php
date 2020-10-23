@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row shadow col-md-8 col-12 offset-2 justify-content-center p-0">
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ URL::asset('https://images.pexels.com/photos/4049870/pexels-photo-4049870.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500')}}" class="img-fluid border-0">
        </div>
        <div class="col-md-6 col-12 bg-light">
            <div class="card bg-transparent text-dark border-0">

                <div class="card-body">

                    <div class="card-header text-center p-5 bg-transparent text-primary border-0">
                        <i class="fas fa-university fa-lg" style="font-size: 100px"></i>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-control-label font-weight-normal">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control border-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-control-label font-weight-normal">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control border-dark @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label font-weight-normal" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="px-md-4">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="pt-5 mt-5 align-bottom h-100 text-right">
                        <a href="#" class="card-link text-warning" data-toggle="modal" data-target="#TestingAccountModal">Testing Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div

 <!-- Testing Account Modal-->
  <div class="modal fade" id="TestingAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Testing Account List</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card m-1 border-left-danger">
                <ul class="list-group text-decoration-none">
                    <li class="list-group-item">
                        <span class="text-dark font-weight-bold">Admin Account</span>
                        <br>
                        Email  - admin@gmail.com
                        <br>
                        Password - password
                    </li>
                </ul>
            </div>

            <div class="card m-1 border-left-primary">
                <ul class="list-group text-decoration-none">
                    <li class="list-group-item">
                        <span class="text-dark font-weight-bold">Marketing Manager Account</span>
                        <br>
                        Email  - marketingmanager@gmail.com
                        <br>
                        Password - password
                    </li>
                </ul>
            </div>

            <div class="card m-1 border-left-info">
                <ul class="list-group text-decoration-none">
                    <li class="list-group-item">
                        <span class="text-dark font-weight-bold">Marketing Coordinor Account</span>
                        <br>
                        Email  - marketingcoordinor@gmail.com
                        <br>
                        Password - password
                    </li>
                </ul>
            </div>

            <div class="card m-1 border-left-success">
                <ul class="list-group text-decoration-none">
                    <li class="list-group-item">
                        <span class="text-dark font-weight-bold">Student Account</span>
                        <br>
                        Email  - student@gmail.com
                        <br>
                        Password - password
                    </li>
                </ul>
            </div>

            <div class="card m-1 border-left-secondary">
                <ul class="list-group text-decoration-none">
                    <li class="list-group-item">
                        <span class="text-dark font-weight-bold">Guest Account</span>
                        <br>
                        Email  - guest@gmail.com
                        <br>
                        Password - password
                    </li>
                </ul>
            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection
