@extends('template')
@section('content')

<section class="container">
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif

    <!-- ttile -->
    @can('isMarketingCoordinator')
      <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">                
          Contributions of Your Faculty's students
      </h5>
    @elsecan('isMarketingManager')
      <h5  class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">
          Contributions of {{$coordinatorContributions[0]->faculty()->name}}
      </h5>
    @elsecan('isGuest')
    <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">                
      Published Contributions of Your Faculty's students
    </h5>
    @endcan
    <div class="card border-left-primary p-2">
      <!-- filter row -->
      @if(isset($coordinatorContributions))
        <table class="table d-md-table table-responsive w-100 text-center" id="table-resize-collapse">
            <thead class="bg-dark-primary text-white rounded-lg">
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Issue Title</th>
                  @can('isMarketingManager')
                  <th scope="col">Publication Status</th>
                  @endcan
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
                      @can('isMarketingCoordinator')
                        <td>
                          <a href="{{route('coordinator.contributions.show',$contribution->id)}}">
                              <button class="btn btn-primary">View Contribution</button>
                          </a>
                          <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                            <button class="btn btn-success">Download Files</button>
                          </a>
                        </td>
                    </tr>
                    @elsecan('isMarketingManager')
                      <td>
                        @switch($contribution->is_published)
                            @case(1)
                            Published
                                @break
                            @case(2)
                            Rejected
                                @break
                            @case(0)
                            Pending
                                @break
                            @default
                                
                        @endswitch
                      </td>
                      <td>
                        <a href="{{route('manager.contributions.show',$contribution->id)}}">
                            <button class="btn btn-primary">View Contribution</button>
                        </a>
                        <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                          <button class="btn btn-success">Download Files</button>
                        </a>
                      </td>

                    @elsecan('isGuest')
                    <td>
                      <a href="{{route('guest.selected-contributions.show',$contribution->id)}}">
                          <button class="btn btn-primary">View Contribution</button>
                      </a>
                      <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                        <button class="btn btn-success">Download Files</button>
                      </a>
                    </td>
                    @endcan
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

