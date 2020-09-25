<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="container p-3">
    <h4 class="col-12">User List</h4>
        @foreach($users as $user)
            <div class="border row p-3 m-1">
                <div class="col-2">
                    {{$user->username}}
                </div>
                <div class="col-2">
                    {{$user->fullname}}
                </div>
                <div class="col-2">
                    {{$user->email}}
                </div>
                <div class="col-2">
                      <select class="form-control" name="role_id" id="">
                        <option>Admin</option>
                        <option>Student</option>
                        <option>Marketing Manager</option>
                      </select>
                </div>
                <div class="col-3 row">
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
    </div>
    
</body>
</html>