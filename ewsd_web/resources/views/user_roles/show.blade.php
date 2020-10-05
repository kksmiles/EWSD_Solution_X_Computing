@extends('template')
@section('content')
    <section class='container'>
        <h1>Role : {{ $user_role->roles }}</h1>
        <a href="{{route('user_roles.index')}}" class='btn btn-warning'>Back</a>
        {{-- <p>Description : {{ $academic_year->description }}</p> --}}
    </section>
@endsection