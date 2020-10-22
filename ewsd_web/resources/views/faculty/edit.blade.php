@extends('template')
@section('content')
<section class="container">
    <div class="card border-left-primary">
        <div class="card-header text-primary font-weight-bold">
            Faculty Update Form 
        </div>
        <div class="card-body">
           <div style="margin:0 auto; text-align:center; color:#fff; background:red;">
                @if ($errors->any())
                        @foreach ($errors->all() as $error)
                           <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                                <strong>{{ $message }}</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                @endif
            </div>
         
            <div class="container">
                <form action="{{route('faculty.update')}}" method="POST">
                @csrf
                    <input type="hidden" class="form-control" value="{{$faculty->id}}" name="id">

                    <div class="form-group">
                        <label for="name" class="form-control-label">Faculty Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$faculty->name}}" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-control-label">About Faculty</label>
                        <textarea id="message" name="desc" class="form-control" placeholder="Message">{{$faculty->description}}</textarea>
                        
                    </div>

                    <div class="justify-content-between col-12 row">
                        <a href="{{route('faculty.index')}}" class="btn btn-warning">Back</a>
                        <input type="submit" class="btn btn-primary" value="Update Faculty">
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    
</section>
@endsection
     