@extends('template')
@section('style')
<style>
    .profile{
        width: 100px;
        height: 100px;
    }
</style>

@endsection
@section('content')

<section class='container'>

    <div class="card border-left-primary">
    
        <div class='card-header'>
            <img src="{{ asset($user->image) }}" alt="" onerror="this.src='https://png.pngitem.com/pimgs/s/35-350426_profile-icon-png-default-profile-picture-png-transparent.png'" class="img-thumbnail rounded-circle profile offset-md-5 offset-3">
        </div>


        <div class="card-body row col-12">
            <div class="col-md-6 col-12">
                <ul class='list-group offset-md-3 shadow mt-3'>
                <div class="list-group-item bg-primary p-0">
                    <span class='font-weight-bold text-white'>&nbsp;{{ $user->fullname }}'s Personal Info </span>
                    <a href="{{ route('users.edit',$user->id) }}" class='btn btn-primary float-right btn-sm'>
                        <span class='fas fa-pen'></span>
                    </a>
                </div>
                    <li class='list-group-item'>Username - <span class='font-weight-bold text-primary'>{{$user->username}}</span></li>
                    <li class='list-group-item'>FullName - <span class='font-weight-bold text-primary'>{{$user->fullname}}</span></li>
                    <li class='list-group-item'>Email - <span class='font-weight-bold text-primary'>{{$user->username}}</span></li>
                    <li class='list-group-item'>User role -
                     @isset($user->role_id)
                        <span class='font-weight-bold text-primary'>{{$user->role->roles}}</span>
                     @else
                        <span class='font-weight-bold text-danger'>Not Assign</span>
                     @endisset
                     </li>
                </ul>
                <div class='list-group-item offset-md-3 mt-3 rounded shdow'>
             
                    <form action="{{ route('user_role.assign') }}" method="POST" class='row'>

                        @csrf

                        <input type="hidden" name="user_id" value='{{ $user->id }}'> 
                        <label for="" class="form-check-label small d-block col-12 p-1">Assign User Role</label>
                        <select name="role_id" id="" class='form-control col-8 ml-2'>
                            @foreach($roles as $role)
                                $user_role_id = $user->role_id;
                                $role_id = $role->id;
                                <option value="{{ $role->id }}" {{ ( $user->role_id == $role->id) ? 'selected' : '' }}>{{ $role->roles }}</option>
                            @endforeach
                        </select> 
                        <button class='btn btn-primary btn-sm float-right ml-3'>
                            {{ ( $user->role_id == "") ? 'Assign' : 'Update' }}
                        </button>
                    </form>
                </div>

            </div>
            <div class="col-md-6 col-12">
                <div class="row col-md-8 col-12 ml-1 ml-md-0 p-md-2">
                    <span class='col-12 p-1 font-weight-bold bg-primary text-white'>{{ $user->fullname }}'s Faculty List</span>
                    <ul class='list-group rounded-0 col-12 shadow p-0 '>
                        @foreach($user->faculties as $faculty)
                            <li class='list-group-item small text-dark font-weight-bold'>
                                <span class='float-left'>{{ $faculty->name }}</span>
                                <form action="{{ route('user_faculty.unassign') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                                    <input type="hidden" name="faculty_id" id="" value="{{ $faculty->id}}">
                                    <button class='btn btn-sm btn-outline-danger border-0 float-right' onclick="return confirm('Are You Sure? ')">
                                        <span class="fas fa-times"></span>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                        <li class='list-group-item'>
                            <form action="{{ route('user_faculty.assign') }}" method='POST' class='row p-0'>
                                @csrf
                                <label for="" class="form-label col-12 p-0 small">Assign Faculty</label>
                                <input type="hidden" name='user_id' value='{{$user->id}}'>
                                <select name="faculty_id" id="" class='form-control col-8'>
                                    @foreach($faculties as $faculty)
                                        @if(!in_array($faculty->id,$current_user_f_id))   
                                            <option value="{{ $faculty->id }}" >{{ $faculty->name }}</option>
                                        @endif  
                                    @endforeach
                                </select>
                                <button class='btn btn-primary col-md-3 col-4 m-ml-0 m-1 mx-2 btn-sm'>
                                    Assign
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div>

                    <a href="{{ route('users.index') }}" class='btn btn-light'><span class='fas fa-arrow-left '>&nbsp;Back to home</span></a>

                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
       <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong>{{ $message }}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif




</section>

@endsection

