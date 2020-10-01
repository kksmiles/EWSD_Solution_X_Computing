<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users in Faculty List</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
@if ($message = Session::get('success'))
<div style="margin:0 auto; text-align:center; background:green; color:#fff;">
        <strong>{{ $message }}</strong>
</div>
@endif
<div class="container p-3">
  <h3>{{$faculties[$f_id-1]->name}}</h3>
  <form class="form-inline" action="{{route('user_faculty.select')}}">
    <div class="form-group mb-2">
      <label for="faculty_name">Select Faculty : </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <select class="form-control" name="faculty_id">
        @foreach ($faculties as $faculty)
        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
        @endforeach     
      </select>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Confirm</button>
  </form>

  <div class="form-group row btn btn-primary mb-2">
    <a class="btn" href="{{route('user_faculty.add',$f_id)}}">Add Users to Faculty</a>
  </div>

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
        @foreach($users_in_faculty as $key => $user_in_faculty)
          <tr>
              <td> {{$key+1}} </td>
              <td scope="col">{{$user_in_faculty->user->fullname}}</td>
              <td> {{$user_in_faculty->user->email}}</td>
              <td> {{$user_in_faculty->user->role->roles}}</td>
              <td>
                <form action="{{ route('user_faculty.destroy',[$user_in_faculty->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="confirm('Are you Sure?')">Remove</button>
                </form>
              </td>
              <td>
                  <a href="{{ route('user_faculty.edit',$key+1)}}" class="btn btn-sm btn-info">Edit</a>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
  </div>
</body>
</html> 