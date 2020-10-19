@extends('template')
@section('style')
<style>
 
</style>
@endsection
@section('content')
<section class='container p-1 m-md-0 '>
   
    <div class="card shadow col-md-6 border-left-primary col-12 p-0 offset-md-3 "> 

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
          @foreach($user_roles as $key => $user_role) 
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$user_role->roles}}</td>
                <td>
                    <a href="{{route('user_roles.edit',$user_role->id)}}">
                        <button class='btn btn-outline-primary'>Edit</button>
                    </a>
                </td>
                <td>
                    <a>
                      <form action="{{route('user_roles.destroy',$user_role->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="submit" onclick="return confirm('Are You Sure?')" class='btn btn-outline-danger' value="Delete">
                      </form>
                    </a>
                </td>
              </tr>
          @endforeach


        
              <tr>
                <form action="{{ route('user_roles.store') }}" method="POST">
                 @csrf
                  <td colspan="2 float-right">
                     <input type="text" class='form-control' placeholder="Enter User Role Name" name="roles" required>
                  </td>
                  <td colspan="2">
                    <button type="submit" class='btn btn-toolbar btn-primary float-left'>
                        <i class="fas fa-sm fa-plus pl-1">  </i>&nbsp; New Role
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

</section>
@endsection

@section('script')

<script type="text/javascript">

  $(document).ready(()=>{

  });

</script>
@endsection