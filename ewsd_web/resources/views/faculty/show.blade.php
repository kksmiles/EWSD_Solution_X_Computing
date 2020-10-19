@extends('template')
@section('content')
    <section class='container'>
        <h3>{{$faculty->name}}</h3>
        <p>{{$faculty->description}}</p>
        <button><a href="{{route('coordinator.faculty.users.show',$faculty->id)}}">Check Students</a></button>
        <button><a href="{{ route('coordinator.magazine-issues.index') }}">Check Issues </a></button>
        <button><a href="{{ route('coordinator.contributions.index') }}">Check Contributions </a></button>
    </section>
@endsection
