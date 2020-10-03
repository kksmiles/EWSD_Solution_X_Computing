@extends('template')
@section('content')

<section class="container-fluid">
<table class="table table-responsive ">
    <thead>
        <th>NO</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Faculty</th>
        <th class="">Action</th>
    </thead>
    <tbody >
        
        @foreach($users as $user)
            <tr>
                <td> {{$user->id}} </td>
                <td>{{$user->username}}</td>
                <td> {{$user->fullname}} </td>
                <td> {{$user->email}}</td>
                <td> {{$user->role->roles}}</td>
                <td>
                    <div class="row col-8 p-0 d-inline-block">
                        @foreach($user->faculties as $faculty)
                             <span class="badge badge-info m-1">{{ $faculty->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <div class="row ">
                        <div class="">
                            <a href="{{ route('users.show',$user->id)}}" class="btn btn-sm btn-primary">
                                <span class='fa fa-user'> Detail</span>
                            </a>
                        </div>
                        <form action="{{ route('users.destroy',$user->id)}}" method="post" class='mt-1'>
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">
                                    <span class='fas fa-trash'> Delete</span>
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>


    </table>
</section>
@endsection
