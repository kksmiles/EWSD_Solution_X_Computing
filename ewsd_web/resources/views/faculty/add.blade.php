@extends('template')
@section('content')

<section class="container">
   
    <div class="card border-left-primary p-3">   
        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger  alert-dismissible fade show m-2" role="alert">
                        <strong>{{ $error }}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                    </div>
                @endforeach
        @endif
        <form action="{{route('faculty.save')}}" method="POST">
        @csrf

        <div class="form-group">   
            <label class="form-control-label" for="name">Faculty Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">   
            <label class="form-control-label" for="message">About Faculty</label>
            <textarea id="message" name="desc" class="form-control" placeholder="Message"></textarea>
        </div>
        <div class="row px-3 m-auto justify-content-between">   
            <a href="{{route('faculty.index')}}" class="btn btn-warning">Back</a>
            <input type="submit" class="btn btn-primary" value="Add New Faculty">
        </div>
        </form>
    </div>
 


</section>
@endsection
