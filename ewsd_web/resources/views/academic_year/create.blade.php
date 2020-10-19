@extends('template')
@section('content')
<section class="container">

    <div class="card border-left-primary p-3">
       <div class="card-header-pills px-2 ">
           <h5 class="font-weight-bold text-primary">Create Academic Year</h5>
       </div>
       <div class="card-body">
        <form action="{{ route('academic-years.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <span class="form-control-label" for='title'>Title</span>
                <input type="text" class="form-control" name="title" id="title">
            </div>

             <div class="form-group">
                <span class="form-control-label" for='description'>Desctiption</span>
                <textarea class="form-control" name="description"></textarea>
            </div>

             <div class="form-group">
                <span class="form-control-label" for='closure_date'>Closure Date</span>
                <input type="date" class="form-control" name="closure_date" id="closure_date">
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </form>
           
       </div>
        
    </div>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</section>
@endsection