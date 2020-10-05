@extends('template')
@section('content')
 <section class='container'>
    <form action="{{ route('academic-years.update', $academic_year->id) }}" method="POST">
        @csrf
        @method('PATCH')
        Title : <input type="text" name="title" value="{{ $academic_year->title }}" class='form-control' required>
        <br>
        Description : <input type="text" name="description" value="{{ $academic_year->description }}" class='form-control' required>
        <br>
        Closure Date : <input type="date" name="closure_date" value="{{ $academic_year->closure_date }}" class='form-control' required>
        <button type="submit" class='btn btn-primary mt-3'>Save</button>
    </form>

    @if ($errors->any())

    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    @endif
 </section>
@endsection