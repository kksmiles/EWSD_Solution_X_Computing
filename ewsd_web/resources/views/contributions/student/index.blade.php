@extends('template')
@section('content')

<section class="container">
  
    @if ($message = Session::get('success'))
    <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
            <strong>{{ $message }}</strong>
    </div>
    @endif
      <caption>
        
        <a href="{{route('contribution.upload')}}" class="btn btn-primary">
          Upload New Contribution
        </a>

      </caption>
      <div class="card border-left-primary p-3 mt-md-2">
        <div class="card-body">
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
                <th>View Contribution</th>
              </tr>
            </thead>
                <tbody> 
                  @foreach($contributions as $key => $contribution)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$contribution->title}}</td>
                      <td>{{$contribution->magazineIssueTitle}}</td>
                      <td>{{$contribution->facultyName}}</td>
                      <td>{{$contribution->academicYear}}</td>
                      <td>{{$contribution->is_published == '0' ? 'Pending' : 'Published'}}</td>
                      <td>{{$contribution->created_at}}</td>
                      <td>
                          <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                            <button>Download Files</button>
                          </a>
                      </td>
                      <td>
                          <a href="{{route('contribution.student.edit',$contribution->id)}}">
                            <button>Update Contribution</button>
                          </a>
                      </td>
                      <td>
                        <a href="{{route('contribution.student.show',$contribution->id)}}">
                          <button>View Contribution</button>
                        </a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    
</section>
@endsection