@extends('template')
@section('css')

@endsection

@section('content')

@if ($message = Session::get('success'))
<div style="margin:0 auto; text-align:center; background:green; color:#fff;">
        <strong>{{ $message }}</strong>
</div>
@endif

@if(isset($getContributions))
<div style="margin:10px auto; text-align:center">
    <h5>
      <form action="{{route('coordinator.magazine-issues.contributions.url')}}" method="POST">
        @csrf
      <select name="issue_id" onchange="this.form.submit()">
        @foreach($issues as $issue)
          @if($issue->id == $id)
            <option value="{{$issue->id}}" selected="true" >{{$issue->title}}</option>
          @else
            <option value="{{$issue->id}}">{{$issue->title}}</option>
          @endif
        @endforeach
      </select>
    </form>
       
    </h5>
    <p>
        {{$issue->description}}
        <a href="{{route('coordinator.magazine-issues.index')}}" class="btn btn-primary ml-2">
          Back to issues
        </a>
    </p>
    <hr>
    
</div>
<div class="card border-left-primary p-3 mt-md-2">
        <div class="card-body">
<table class="table table-responsive d-md-table d-md-table">
  <thead class="bg-dark-primary text-white small">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Contribution Name</th>
      <th>Description</th>
      <th>Student Name</th>
      <th>Uploaded Date</th>
      <th>File</th>
      <th>Status</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
    @foreach($getContributions as $key => $contribution)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$contribution->title}}</td>
            <td>{{$contribution->description}}</td>
            <td>{{$contribution->student()->first()->fullname}}</td>
            <td>{{$contribution->created_at}}</td>
            <td>
                <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                <button class="btn btn-success">Download Files</button>
                </a>
            </td>
            <td style="display:flex">
                @if($contribution->is_published == '0')
                <form action="{{ route('coordinator.contributions.publish',$contribution->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Publish</button>
                </form>
                <form action="{{ route('coordinator.contributions.reject',$contribution->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger ml-2">Reject</button>
                </form>
                @else
                    @if( $contribution->is_published == '1')
                        <span style="background: green; color: #fff;">Published</span>
                    @else
                        <span style="background: red; color: #fff;">Rejected Manually</span>
                    @endif
                @endif
            </td>
            <td>
                <a href="{{route('coordinator.contributions.show',$contribution->id)}}"> 
                  <button class="btn btn-warning"> Give Comment</button>
                </a>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@else
    <div style="margin:10px auto; text-align:center">
        There is no contributions in this issue
        <a href="{{route('coordinator.magazine-issues.index')}}">
            <button class="btn btn-warning">Back to issues</button>
        </a>
    </div>
@endif
@endsection