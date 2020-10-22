@extends('template')
@section('style')
<style type="text/css">
    .issue-content
    {
        position: absolute;
        top: 300px;
        border-radius: 20px;
    }
   @media only screen and (max-width: 600px)
   {
    .issue-container
    {
        height: 1050px !important;
    }
   }
</style>
@endsection
@section('content')
    <section class='container'>

        <div class="card h-100 shadow border-left-primary issue-container p-3">
            <div class="card-header text-primary">
                <h5> {{ $magazine_issue->title }}</h5>
            </div>
            <img src="https://images.pexels.com/photos/1391582/pexels-photo-1391582.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="figure-img card-img-top" height="400px">
            <div class="card-body bg-light col-11 ml-md-4 issue-content">
                <div class="row px-md-2">
                    <div class="col-md-3 p-md-0 p-1">
                        Title : <span class="text-primary font-weight-bold">{{ $magazine_issue->title }}</span>
                    </div>
                    <div class="col-md-3 p-md-0 p-1">
                       Academic Year: <span class="text-primary font-weight-bold">{{ $magazine_issue->academic_year->title }}</span> 
                    </div>
                    <div class="col-md-3 p-md-0 p-1">
                        Staff in charge : <span class="text-primary font-weight-bold">{{ $magazine_issue->staff->fullname }}</span>
                    </div>

                    <div class="mt-md-3 card p-3 col-md-7 col-12 mx-md-3">
                        <p class="bg-light">{{ $magazine_issue->description }}</p>

                        <ul class="list-group border-0 smla">
                            <li class="list-group-item">
                                Submission Closure Date : <span class="text-warning font-weight-bold text-monospace">
                                    {{ date('jS F Y', strtotime($magazine_issue->submission_closure_date)) }}
                                    </span>
                            </li>
                            
                            <li class="list-group-item">
                                Modification Closure Date : <span class="text-danger
                                 font-weight-bold text-monospace">{{ date('jS F Y', strtotime($magazine_issue->modification_closure_date)) }}</span>
                            </li>
                            <li class="list-group-item">
                                Associated Faculty : <span class="text-primary font-weight-bold text-monospace"> {{ $magazine_issue->faculty->name }} </span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 card mt-md-3">
                        @php
                            session(['issue-id' => $magazine_issue->id ]);
                        @endphp
                        <a href="{{ $magazine_issue->file }}" class='btn btn-success mt-2' download="">
                            <i class="fas fa-download"></i> Download associated file</a>
                        @if(Gate::allows('isStudent'))
                            <a class="btn btn-info mt-2" href="{{ route('student.magazine-issues.contributions', $magazine_issue->id) }}">
                                Your Contributions on this issue
                            </a>
                            <a class="btn btn-primary mt-2" href="{{route('contribution.upload')}}">
                                Upload Contribution
                            </a>
                        @elseif(Gate::allows('isMarketingCoordinator'))
                            <a class="btn btn-primary mt-2" href="{{ route('coordinator.magazine-issues.contributions.show', $magazine_issue->id) }}">Check Contributions </a>
                        @elseif(Gate::allows('isMarketingManager'))
                            <a class="btn btn-primary mt-2" href="{{ route('manager.magazine-issues.contributions', $magazine_issue->id) }}">Check Contributions </a>
                        @endif
                            
                    </div>
                </div>
            </div>
            <div class="card-footer">
                
    </section>
@endsection