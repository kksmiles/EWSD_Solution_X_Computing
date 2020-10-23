@extends('template')
@section('style')
<style>
    .profile
    {
        width: 100px;
        height: 100px;
    }
</style>
@endsection
@section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-left-primary shadow">
                    <div class="card-header">Edit User</div>
                    
                    <div class="card-body">

                    <div class="col-3 offset-md-5 offset-3 p-3">
                        <img src="{{ $user->image }}" class="img profile rounded-circle" onerror="this.src='https://png.pngitem.com/pimgs/s/35-350426_profile-icon-png-default-profile-picture-png-transparent.png'">
                    </div>
                        <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label font-weight-normal text-md-right">User Name</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fullname" class="col-md-4 font-weight-normal col-form-label text-md-right">Full-Name</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $user->fullname }}" required autocomplete="fullname" autofocus>

                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 font-weight-normal col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" readonly>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label font-weight-normal text-md-right">Profile Image</label>

                                <div class="col-md-6">
                                    <label for="new_image" class="btn btn-block btn-primary"><i class="fa fa-file px-1"></i> : Choose new Profile</label>
                                    <input id="old_image" type="hidden" value="{{$user->image}}" class="form-control" name="old_image">
                                    <input id="new_image" type="file" class="d-none form-control @error('new_image') is-invalid @enderror" name="new_image">

                                    @error('new_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Edit
                                    </button>
                                    <a href="{{route('users.show',$user->id)}}" class="btn btn-outline-warning">
                                        Cancel
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



