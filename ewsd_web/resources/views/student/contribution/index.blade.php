@extends('template')
@section('style')
<style>

</style>
@endsection
@section('content')
<section class="container">
  <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">
    Your Contributions {{ Session::get('header') }}
  </h5>
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <table class="table table-responsive d-md-table d-md-table">
    <thead class="bg-dark-primary text-white small">
      <tr>
        <th>No.</th>
        <th>Title</th>
        <th>Issue Name</th>
        <th>Faculty Name</th>
        <th>Acedemic Year</th>
        <th>Status</th>
        <th>Uploaded At</th>
        <th>File</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contributions as $key => $contribution)
          <tr>
          <td>{{$key+1}}</td>
          <td>{{$contribution->title}}</td>
          <td>{{$contribution->magazineIssue->title}}</td>
          <td>{{$contribution->faculty()->name}}</td>
          <td>{{$contribution->magazineIssue->academic_year->title}}</td>
          <td>
            @switch($contribution->is_published)
              @case(0)
                  <span class="text-secondary"> Pending </span>
                  @break
              @case(1)
                <span class="text-primary"> Published </span>
                  @break
              @default
                  <span class="text-danger"> Rejected </span>
            @endswitch
          </td>
          <td>{{$contribution->created_at}}</td>
          <td>
            <a href="{{ $contribution->file }}">
              <button class="btn btn-success">Download Files</button>
            </a>
            </td>
            <td>
                <a href="{{route('contribution.student.edit',$contribution->id)}}">
                  <button class="btn btn-primary">Update Contribution</button>
                </a>
            </td>
            <td>
              <a href="{{route('contribution.student.show',$contribution->id)}}">
                <button class="btn btn-info"> View Contribution</button>
              </a>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  @if(Auth::user()->role_id == 4)
    <a href="{{route('contribution.upload')}}">
      <button class="float-right btn btn-primary">Upload new contribution</button>
    </a>
  @endif
</section>
@endsection