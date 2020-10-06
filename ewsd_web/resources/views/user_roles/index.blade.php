@extends('template')
@section('style')
<style>
 
</style>
@endsection
@section('content')
<section class='container'>
    @if ($message = Session::get('success'))
    <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <table class='table table-bordered'>
      <caption class='p-3'>
        User Roles
        <a href="{{route('user_roles.create')}}" class='btn btn-primary'>
          Add New
        </a>

      </caption>
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Roles</th>
          <th colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($user_roles as $key => $user_role)
            <tr>
            <td>{{$key+1}}</td>
            <td>{{$user_role->roles}}</td>
            <td>
                <a href="{{route('user_roles.edit',$user_role->id)}}">
                    <button class='btn btn-primary'>Edit</button>
                </a>
            </td>
            <td>
                <a>
                  <form action="{{route('user_roles.destroy',$user_role->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="submit" onclick="return confirm('Are You Sure?')" class='btn btn-danger' value="Delete">
                  </form>
                </a>
            </td>
            <td>
              <a href="{{route('user_roles.show',$user_role->id)}}">
                <button class='btn btn-info'>Show</button>
              </a>
            </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</section>
@endsection