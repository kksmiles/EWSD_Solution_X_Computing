@extends('template')
@section('content')

<section class="container-fluid">

<div class='card container shadow border-left-primary'>
    <h4 class="my-3">User List</h4>
        <table class="table table-responsive rounded-lg ">
            <thead class=" text-white font-weight-light bg-dark-primary">
                <tr>
                    <th scope='col'>NO</th>
                    <th scope='col'>Username</th>
                    <th scope='col'>Full Name</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Role</th>
                    <th scope='col'>Faculty</th>
                    <th scope='col' >Action</th>
                </tr>
            </thead>
            <tbody >
                
                @foreach($users as $user)
                    <tr >
                        <td> {{$user->id}} </td>
                        <td class="text-dark font-weight-bold">{{$user->username}}</td>
                        <td> {{$user->fullname}} </td>
                        <td > {{$user->email}}</td>
                        <td> {{$user->role->roles}}</td>
                        <td>
                            <div class="row col-8 p-0 d-inline-block">
                                @foreach($user->faculties as $faculty)
                                    <span class="badge d-inline-block badge-info">{{ $faculty->shortname }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="">
                                    <a href="{{ route('users.show',$user->id)}}" class="btn btn-block btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </div>
                                <form action="{{ route('users.destroy',$user->id)}}" method="post" class='mt-1'>
                                    @csrf
                                    @method('DELETE')
                                        <button class="btn btn-outline-danger btn-block btn-sm" onclick="return confirm('Are you Sure?')">
                                            <span class=''> Delete</span>
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
    
    
        </table>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
</div>


</section>
@endsection
