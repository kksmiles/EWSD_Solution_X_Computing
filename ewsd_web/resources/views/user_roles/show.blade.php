@extends('template')
@section('style')
  
@endsection
@section('content')
<section>
    <div style="margin:0 auto; text-align:center; color:#fff; background:red;">
        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        @endif
    </div>
    
    <div class="container">
        <form action="{{route('user_roles.update',$user_role->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class='form-group'>
                <input type="hidden" value="{{$user_role->id}}" name="id">
                <label for="roles" class='form-check-label'>Roles Name</label>
                <input type="text" class='form-control' id="roles" name="roles" value="{{$user_role->roles}}" placeholder="Role">
            </div>
                <input type="submit" value="Update Role" class='btn btn-primary'>
                <a href="{{route('user_roles.index')}}" class='btn btn-warning'>Back</a>
        </form>
    </div>

</section>
@endsection