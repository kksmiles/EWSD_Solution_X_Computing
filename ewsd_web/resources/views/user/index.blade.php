@extends('template')
@section('content')

<section class="container-fluid">

<div class='card container shadow border-left-primary'>
    <div class="row p-3 justify-content-between">
        <h4 class="">User List</h4>
        <a class="btn btn-sm btn-primary" href="{{route('user.register')}}"><i class="fas fa-plus"></i> Add User</a>
    </div>
        <table class="table table-responsive d-md-table rounded-lg ">
            <thead class=" text-white font-weight-light bg-dark-primary">
                <tr class="d-sm-none">
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
                    <tr class="col-12">
                        <td> {{$user->id}} </td>
                        <td class="text-dark font-weight-bold">{{$user->username}}</td>
                        <td> {{$user->fullname}} </td>
                        <td > {{$user->email}}</td>
                        <td>

                        @if(isset($user->role->roles))
                            {{$user->role->roles}}
                        @else 
                            <span class="text-danger small">Not Assign yet!</span>
                        @endif  

                        </td>
                        <td>
                            <div class="row col-8 p-0 d-inline-block">
                                @if(count($user->faculties) != 0)
                                    @foreach($user->faculties as $faculty)
                                        <span class="badge d-inline-block badge-info">{{ $faculty->shortname }}</span>
                                    @endforeach
                                @else

                                      <span class="text-danger small">Not Assign yet!</span>

                                @endif
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
