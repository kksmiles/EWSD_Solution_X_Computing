@extends('template')
@section('content')

<section class="container">
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif

    <!-- ttile -->
    <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">                
        Contributions of Your Faculty's students
    </h5>

    <div class="card border-left-primary p-2">
      <!-- filter row -->
      @if(isset($coordinatorContributions))
        <table class="table d-md-table table-responsive w-100 text-center">
            <thead class="bg-dark-primary text-white rounded-lg">
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Issue Title</th>
                  <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coordinatorContributions as $key => $contribution)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$contribution->title}}</td>
                    <td>{{$contribution->description}}</td>
                    <td>{{$contribution->student->fullname}}</td>
                    <td>{{$contribution->magazineIssue->title}}</td>
                      <td>
                        <a href="{{route('coordinator.contributions.show',$contribution->id)}}">
                            <button class="btn btn-primary">View Contribution</button>
                        </a>
                      </td>
                      <td>
                        <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                          <button class="btn btn-success">Download Files</button>
                        </a>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="font-weight-bold p-2 text-dark">
              There is no contributions currently.
            <hr>
        </h5>
        @endif
    </div>

</section>

@endsection
