@extends('template')
@section('content')
 <section class='container'>
    <h1>Academic Year : {{ $academic_year->title }}</h1>
    <p>Description : {{ $academic_year->description }}</p>
    <p>Closure Date : {{ $academic_year->closure_date }}</p>

    <a href='{{ route('academic-years.index') }}' class='btn btn-warning'>Back</a>
</section>
@endsection