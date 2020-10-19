@extends('template')
@section('content')
 <section class='container'>

    <div class="card p-3 border-left-primary ">
        <div class="card-header">
            <h5 class="font-weight-bold text-primary">Edit Academic Year</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('academic-years.update', $academic_year->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <span class="form-control-label" for='title'>Title</span>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $academic_year->title}}">
                </div>

                 <div class="form-group">
                    <span class="form-control-label" for='description'>Desctiption</span>
                    <textarea class="form-control" name="description">{{ $academic_year->description}}</textarea>
                </div>

                 <div class="form-group">
                    <span class="form-control-label" for='closure_date'>Closure Date</span>
                    <input type="date" class="form-control" name="closure_date" value="{{ $academic_year->closure_date}}" id="closure_date">
                </div>
                <button type="submit" class='btn btn-primary mt-3'>Save</button>
            </form>
        </div>
        <div class="card-footer">
            @if ($errors->any())

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            @endif
        </div>
        
    </div>

 </section>
@endsection