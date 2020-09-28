<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Users to Faculty</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
    <div class="container">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h3>Add users to Faculty</h3>
        <table class="col-12 table">
            <thead class="thead-dark">
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
                        <form action="{{ route('user_faculty.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="faculty_id" value="{{$f_id}}">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button class="btn btn-info btn-sm" onclick="confirm('Are you Sure?')">Add</button>
                        </form>
                    </td>
                </tr>
                @endif  
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
