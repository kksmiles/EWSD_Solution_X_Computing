@extends('template')
@section('content')
    <section class='container'>
        <h5 class="font-weight-bold p-2 text-dark">
            {{$magazine_issue->title}} 
            <a href="{{ route('magazine-issues.index')}}" class="btn btn-primary button float-md-right">
                Back
            </a>
            <hr>
        </h5>
        <div class="ml-2">
            <p>Associated Faculty : {{ $magazine_issue->faculty->name }}</p>
            <p>Academic Year: {{ $magazine_issue->academic_year->title }}</p>
            <p>Staff in charge : {{ $magazine_issue->staff->fullname }}</p>
            <h1>Title : {{ $magazine_issue->title }}</h1>
            <p>Description : {{ $magazine_issue->description }}</p>
            <a href="{{ $magazine_issue->file }}" class='btn btn-primary btn-sm' download="">Download associated file</a>
            <img src="{{ $magazine_issue->image }}" alt="">
            <p>Submission Closure Date : {{ $magazine_issue->submission_closure_date }}</p>
            <p>Modification Closure Date : {{ $magazine_issue->modification_closure_date }}</p>
            @if(Gate::allows('isStudent'))
                <h5><a href="{{ route('student.magazine-issues.contributions', $magazine_issue->id) }}">Your Contributions </a></h5>
            @elseif(Gate::allows('isMarketingCoordinator'))
                <h5><a href="{{ route('coordinator.magazine-issues.contributions.show', $magazine_issue->id) }}">Check Contributions </a></h5>
            @elseif(Gate::allows('isMarketingManager'))
                <h5><a href="{{ route('manager.magazine-issues.contributions', $magazine_issue->id) }}">Check Contributions </a></h5>
            @endif
        </div>
    </section>
@endsection