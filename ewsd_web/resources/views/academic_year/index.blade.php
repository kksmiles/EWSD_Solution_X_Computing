@extends('template')
@section('content')
 <section class='container'>
    @foreach($academic_years as $academic_year)
        <div class='row'>
            <div class='col-3'>
              <a href="{{ route('academic-years.show', $academic_year->id) }}">{{ $academic_year->title }}</a>
            </div>
            <div class='col-3'>
              <a href="{{ route('academic-years.edit', $academic_year->id) }}" class='btn btn-info'>Edit</a>
            </div>
            <div class='col-3'>
               <form action="{{ route('academic-years.destroy', $academic_year->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class='btn btn-danger'>Delete</button>   
                </form>
            </div>
        </div>  
    @endforeach
    <br>
    <a href="{{ route('academic-years.create') }}" class='btn btn-primary'>Create</a>
    <br>
    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif    
 </section>
@endsection