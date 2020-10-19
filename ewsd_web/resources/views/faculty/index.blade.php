@extends('template')
@section('style')
<style>

</style>
@endsection
@section('content')
<section>
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <table class="table table-responsive">
    <caption>
      Faculty
      <a href="{{route('faculty.add')}}">
        <button>Add New</button>
      </a>
  
    </caption>
    <thead>
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
              <a href="{{route('faculty.edit',$faculty->id)}}">
                  <button>Edit</button>
              </a>
              <a href="{{route('faculty.delete',$faculty->id)}}">
                  <button>Delete</button>
              </a>
          </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection