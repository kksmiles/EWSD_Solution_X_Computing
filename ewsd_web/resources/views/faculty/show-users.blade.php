@extends('template')
@section('content')
<section>
  @if ($message = Session::get('success'))
   <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
       <strong>{{ $message }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
  </div>
  @endif
  <div class="container p-3">
    <div class="justify-content-between row px-3 py-2">
      <h4 class="font-weight-bold text-primary d-inline-block">{{$faculties[$f_id-1]->name}}</h4>
      <a href="{{ route('faculty.show',$f_id) }}" class="btn btn-sm btn-warning">Back</a>
    </div>

    <div class="card p-3 border-left-primary">
      @if(Gate::allows('isMarketingManager') || Gate::allows('isAdmin'))
      <div class="row pt-2">
        <div class="col-6">
          
          <form class="form-inline p-0" action="{{route('faculty.url')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="faculty_name">Select Faculty : </label>
            </div>
            <div class="form-group mx-sm-3">
              <select class="form-control" name="faculty_id" onchange="this.form.submit()" >
                @foreach ($faculties as $faculty)
                  @if($faculty->id == $faculties[$f_id-1]->id)
                    <option value="{{$faculty->id}}" selected="selected">{{$faculty->name}}</option>
                  @else
                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                  @endif
                @endforeach     
              </select>
            </div>
            {{-- <button type="submit" class="btn btn-primary mb-2">Confirm</button> --}}
          </form>
          
        </div>
        <div class="col-6 text-right">
            
            <a class="btn btn-primary btn-sm" href="{{route('faculty.users.add',$f_id)}}">
              <i class="fas fa-plus fa-sm"></i> Add Users to Faculty</a>
        
        </div>
      </div>
      @endif  
      <table class="table table-responsive d-md-table">
          <thead class="bg-dark-primary text-white">
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
                    <form action="{{ route('user-faculty.destroy',[$user_in_faculty->id])}}" method="post">
                      @csrf
                      @method('DELETE')
                          <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you Sure?')">Remove</button>
                    </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      
    </div>

    </div>
</section>
<script>

</script>
@endsection

{{-- 
EWSD Project


@extends('template')
@section('content')

<section class="container">
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif

    <!-- ttile -->
    <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">                 {{$faculties[$f_id-1]->name}}
    </h5>

    <div class="card border-left-primary p-2">
   
      <!-- filter row -->
      <div class="row col-12 p-1">

          <!-- Filter Box -->
          <div class="col-8 pt-2">
              <form class="" action="{{route('faculty.url')}}" method="POST">
                
                @csrf

                <div class="form-group">
                  <label for="faculty_name" class="font-weight-normal">Filter Faculty : </label>
                  <select class="form-control-sm " name="faculty_id" onchange="this.form.submit()" >
                    @foreach ($faculties as $faculty)
                      @if($faculty->id == $faculties[$f_id-1]->id)
                        <option value="{{$faculty->id}}" selected="selected">{{$faculty->name}}</option>
                      @else
                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                      @endif
                    @endforeach     
                  </select>
                </div>
    
              </form>
          </div>
          <!-- Filter Box -->

          <!-- Add User to faculty -->
          <div class="pt-2">
              <a class="btn btn-primary btn-sm float-sm-right" href="{{route('faculty.users.add',$f_id)}}">
               <i class="fas fa-plus fa-sm"></i> Assign User
              </a>
          </div>
          <!-- Add User to faculty -->

      </div>

        <table class="table d-md-table table-responsive w-100 text-center">
            <thead class="bg-dark-primary text-white rounded-lg">
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
                    <td class="d-table-cell"> {{$key+1}} </td>
                    <td scope="col">{{$user_in_faculty->user->fullname}}</td>
                    <td> {{$user_in_faculty->user->email}}</td>
                    <td> {{$user_in_faculty->user->role->roles}}</td>
                    <td>
                      <form action="{{ route('user-faculty.destroy',[$user_in_faculty->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you Sure?')">Remove</button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
<script>

</script>

    <section class='container'>
        <h3>{{$faculty->name}}</h3>
        <p>{{$faculty->description}}</p>
        <button><a href="{{route('coordinator.faculty.users.show',$faculty->id)}}">Check Students</a></button>
        <button><a href="{{ route('coordinator.magazine-issues.index') }}">Check Issues </a></button>
        <button><a href="{{ route('coordinator.contributions.index') }}">Check Contributions </a></button>
    </section>

@endsection
--}}
