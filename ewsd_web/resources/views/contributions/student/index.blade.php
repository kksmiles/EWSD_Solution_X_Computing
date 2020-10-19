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
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $key => $data)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data['contribution_name']}}</td>
                    <td>{{$data['issue_name']}}</td>
                    <td>{{$data['faculty_name']}}</td>
                    <td>{{$data['acedemic_year']}}</td>
                    <td>{{$data['is_published'] == '0' ? 'Pending' : 'Published'}}</td>
                    <td>{{$data['uploaded_at']}}</td>
                    <td>
                        <a href="{{asset('storage/contributions/'.$data['file'])}}" download="{{asset('storage/contributions/'.$data['file'])}}">
                          <button>Download Files</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('contribution.student.edit',$data['id'])}}">
                          <button>Update Contribution</button>
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