@extends('template')
@section('content')
    <div class="container">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card border-left-primary p-3">
            <h6 class="text-primary font-weight-bold"> <span class="d-sm-none">Add users to</span> {{ $faculty->name }}</h6>
            
            <hr class="sidebar-divider">


            <table class="table table-responsive-sm text-center">
                <thead class="bg-dark-primary text-white">
                    <tr>
                        <th scope="col">Id.</th>
                        <th scope="col">User name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th colspan="3"> Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $a = 1;
                @endphp
                @foreach($users as $key => $user)  
                    @if(in_array($user->id, $users_in ))
                    @else
                    <tr>
                        <td> {{$a++}} </td>
                        <td scope="col">{{$user->fullname}}</td>
                        <td> {{$user->email}}</td>
                        <td> {{$user->role->roles}}</td>
                        <td>
                            <form action="{{ route('user-faculty.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="faculty_id" value="{{$f_id}}">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button class="btn btn-outline-primary btn-sm" onclick="retun confirm('Are you Sure?')">Add</button>
                            </form>
                        </td>
                    </tr>
                    @endif  
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection