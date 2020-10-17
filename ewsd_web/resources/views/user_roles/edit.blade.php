@extends('template')
@section('style')
<style>
 
</style>
@endsection
@section('content')
<section class='container p-1 m-md-0 row '>
   
    <div class="card shadow col-md-6 border-left-primary col-12 p-0 offset-md-2 "> 

        <table class='table table-striped rounded-lg'>
        <caption class='p-3'>

        </caption>
        <thead class=" text-primary text-center">
          <tr>
            <th >No.</th>
            <th >Roles</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @foreach($user_roles as $key => $userrole) 
            @if($userrole->id != $user_role->id)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$userrole->roles}}</td>
                <td>
                    <a href="{{route('user_roles.edit',$userrole->id)}}">
                        <button class='btn btn-outline-primary'>Edit</button>
                    </a>
                </td>
                <td>
                    <a>
                      <form action="{{route('user_roles.destroy',$userrole->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="submit" onclick="return confirm('Are You Sure?')" class='btn btn-outline-danger' value="Delete">
                      </form>
                    </a>
                </td>
              </tr>
            @endif
          @endforeach


        
              <tr>
                <form action="{{ route('user_roles.update',$user_role->id) }}" method="POST">
                   @csrf
                    @method('PATCH')
                  <td colspan="2 float-right">
                     <input type="text" class='form-control' placeholder="Enter User Role Name" name="roles" value="{{ $user_role->roles }}" required>
                  </td>
                  <td colspan="2">
                    <button type="submit" class='btn btn-toolbar btn-primary float-left'>
                        Update Role
                    </button>  
                  </td>
               </form>
              </tr>

        </tbody>

          @if ($errors->any())
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          @endif

           @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                <strong>{{ $message }}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

      </table>

    </div>

    <div class="col-md-4 col-12 card h-25 pl-3">
         <form action="{{route('user_roles.update',$user_role->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class='form-group'>
                <input type="hidden" value="{{$user_role->id}}" name="id">
                <label for="roles" class='form-check-label font-weight-normal'>Roles Name</label>
                <input type="text" class='form-control' id="roles" name="roles" value="{{$user_role->roles}}" placeholder="Role">
            </div>
                <input type="submit" value="Update Role" class='btn btn-primary float-right'>
        </form>
    </div>

</section>
@endsection

@section('script')

<script type="text/javascript">

  $(document).ready(()=>{

  });

</script>
@endsection