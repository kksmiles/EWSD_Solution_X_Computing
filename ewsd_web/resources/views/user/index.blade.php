
@extends('template')
@section('content')

        @foreach($users as $user)
            <tr>
                <td> {{$user->id}} </td>
                <td scope="col">{{$user->username}}</td>
                <td> {{$user->fullname}} </td>
                <td> {{$user->email}}</td>
                <td> {{$user->role->roles}}</td>
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
                            <button class="btn btn-danger btn-sm" onclick="confirm('Are you Sure?')">Delete</button>
                    </form>
                    <form action="" class='ml-1'>
                        <button class="btn btn-primary btn-sm">Assign</button>
                    </form>
                    <div class="ml-1">
                        <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-info">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach

                </td>
                <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-info">Edit</a>
                </td>
            </tr>
            @endforeach
      @endsection