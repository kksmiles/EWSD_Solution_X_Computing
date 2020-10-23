@extends('template')
@section('style')
<style>
</style>
@endsection
@section('content')
<section class="container">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
       <strong>{{ $message }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
  </div>
  @endif
  <div class="card p-3 border-left-primary shadow">
    @can ('isMarketingManager')  
    @elsecan('isAdmin')   
    <div class="card-header px-4 row bg-transparent border-0 justify-content-between">
      <h5 class="text-primary font-weight-bold">Faculty List</h5>
      <div class="">
         <a href="{{route('faculty.add')}}" class="btn btn-sm btn-primary">
          <i class="fas fa-plus fa-sm"></i> Add Faculty
        </a>
      </div>
    </div>
    @endcan      
    <table class="table table-responsive" id="table-resize-collapse">
      <thead class="bg-dark-primary text-white">
        <tr>
          <td>No.</td>
          <td>Faculty Name</td>
          <td>About</td>
          <td>Established At</td>
          <td colspan="3">Action</td>
        </tr>
      </thead>
      <tbody>
        @foreach($faculties as $key => $faculty)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$faculty->name}}</td>
              <td><p class="d-inline-block" >{{ Str::limit($faculty->description,50,"....") }}</p></td>
              <td>{{ $faculty->created_at->format('d.m.Y') }}</td>
              <td colspan="3">
                  @if (Gate::allows('isMarketingManager'))
                  <a href="{{route('manager.faculty.show',$faculty->id)}}" class="btn btn-block btn-sm btn-outline-info">
                    View
                  </a>
                  @else
                  <a href="{{route('faculty.show',$faculty->id)}}" class="btn btn-block btn-sm btn-outline-info">
                    View
                  </a>
                  <a href="{{route('faculty.edit',$faculty->id)}}" class="btn btn-block btn-sm btn-outline-primary">
                    Edit
                  </a>
                  <a href="{{route('faculty.delete',$faculty->id)}}" class="btn btn-block btn-sm btn-outline-danger">
                     Delete
                  </a>
                  @endif
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>
</section>
@endsection