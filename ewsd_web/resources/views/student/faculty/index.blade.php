@extends('template')
@section('style')
<style>

</style>
@endsection
@section('content')
<section class="container">
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <table class="table table-responsive d-md-table d-md-table">
    <thead class="bg-dark-primary text-white small">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Faculty Name</th>
        <th scope="col">About</th>
        <th scope="col">Established At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($faculties as $key => $faculty)
          <tr>
          <td>{{$key+1}}</td>
          <td>{{$faculty->name}}</td>
          <td>{{$faculty->description}}</td>
          <td>{{$faculty->created_at}}</td>
          <td>
              @if(Auth::user()->role_id == 4)
                <a href="{{ route('student.faculties.magazineissues',$faculty->id) }}">
                  <button class="btn btn-info">See Issues</button>
                </a>
              @endif
              @if(Auth::user()->role_id == 1)
                <a href="{{ route('faculty.show',$faculty->id) }}">
                  <button class="btn btn-info">View</button>
                </a>
                <a href="{{route('faculty.edit',$faculty->id)}}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <a href="{{route('faculty.delete',$faculty->id)}}">
                    <button class="btn btn-danger">Delete</button>
                </a>
              @endif
          </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  @if(Auth::user()->role_id == 1)
    <a href="{{route('faculty.add')}}">
      <button class="float-right btn btn-primary">Add New</button>
    </a>
  @endif
</section>
@endsection