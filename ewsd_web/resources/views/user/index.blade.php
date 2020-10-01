@extends('template')
@section('content')

    {{-- @can('isAdmin')
        Admin can only see
    @elsecan('isStudent')
        Student see
    @endcan --}}
    @if ($message = Session::get('fail'))
        <strong>{{ $message }}</strong>
    @endif   
    <div class="container p-3">
    <h4 class="col-12">User List</h4>
    <table class="col-12 table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id.</th>
                <th scope="col">User name</th>
                <th scope="col">Full name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Faculties</th>
                <th colspan="3"> Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td> {{$user->id}} </td>
                <td scope="col">{{$user->username}}</td>
                <td> {{$user->fullname}} </td>
                <td> {{$user->email}}</td>
                <td> 
                @isset($user->role->roles)    
                    {{$user->role->roles}}
                @else
                   <form action="">
                    <div class="form-group">
                        <select name="user_role" id="">
                            
                        </select>
                    </div> 
                   </form>
                @endisset
            
                </td>
                <td>
                    <select class="form-control" name="role_id" id="">
                        @foreach ($user->faculties as $faculty)
                        <option>{{$faculty->name}}</option>
                        @endforeach     
                    </select>
                </td>
                <td>
                    <form action="{{ route('users.destroy',$user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">Delete</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-info">Edit</a>
                </td>
            </tr>
            @endforeach

@endsection
    
        