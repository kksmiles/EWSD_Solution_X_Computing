@extends('template')
@section('content')
    <section class='container'>
        <p>Associated Faculty : {{ $magazine_issue->faculty->name }}</p>
        <p>Academic Year: {{ $magazine_issue->academic_year->title }}</p>
        <p>Staff in charge : {{ $magazine_issue->staff->fullname }}</p>
        <h1>Title : {{ $magazine_issue->title }}</h1>
        <p>Description : {{ $magazine_issue->description }}</p>
        <a href="{{ $magazine_issue->file }}" class='btn btn-primary btn-sm' download="">Download associated file</a>
        <img src="{{ $magazine_issue->image }}" alt="">
        <p>Submission Closure Date : {{ $magazine_issue->submission_closure_date }}</p>
        <p>Modification Closure Date : {{ $magazine_issue->modification_closure_date }}</p>
    </section>
@endsection