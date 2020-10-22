@extends('template')
@section('content')

<section class="container">
        
        <div class="p-2">
            Modifying {{$contribution->title}}   
        </div> 


    <div class="card border-left-primary p-3">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if ($message = Session::get('success'))
            <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
                    <strong>{{ $message }}</strong>
            </div>
        @endif 
        @if ($message = Session::get('fail'))
            <div style="margin:0 auto; text-align:center; background:red; color:#fff;">
                    <strong>{{ $message }}</strong>
            </div>
        @endif 

        <form action="{{ route('contribution.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$contribution->id}}" name="id">
    
            <div class="form-group">
                Student Name - <span class="text-dark font-weight-bold">{{\Auth::user()->fullname}}</span>
            </div>

            <div class="form-group">
                <span class="form-group">Title</span>
                <input type="text" class="form-control" name="title" value="{{$contribution->title}}">
            </div>

            <div class="form-group">
                <span class="form-group">Description</span>
                <textarea class="form-control" name="description">{{$contribution->description}}</textarea>     
            </div>

            <div class="form-group">
                <span class="form-group">Upload new File</span>
                <input type="file" class="form-control" name="file" >
                <a href="{{asset($contribution->file)}}">
                    Download Current File 
                </a>
            </div>


            <input type="checkbox" id="checkTerm"> <label for="checkTerm">Agree terms and conditions of this issue</label> 
            <br>
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Upload Contributions</button>
        </form>
    </div>
</section> 

@endsection
   
@section('script')
    <script>
        const checkTerm = document.getElementById("checkTerm");
        const submitBtn = document.querySelector("#submitBtn");
        checkTerm.addEventListener('click',() => {
            if(checkTerm.checked){
                submitBtn.removeAttribute('disabled');
            }else{
                submitBtn.setAttribute('disabled','');
            }
        });
    </script>
@endsection