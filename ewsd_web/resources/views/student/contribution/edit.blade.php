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


            <input type="checkbox" id="checkTerm"> <a custor="pointer" href="/" data-toggle="modal" data-target="#TermsModal">Agree terms and conditions of this issue</a> 
            <br>
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Upload Contributions</button>
        </form>
    </div>
 
    <!-- Modal -->
    <div class="modal fade" id="TermsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="font-weight-bold p-2 text-dark">Agree to terms and conditions<br> before submission</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <h5 class="font-weight-bold p-2 text-dark">Terms and conditions</h5>
        <ul class="list-group p-3">
            <li class="">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
            <li class="">Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</li>
            <li class="">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</li>
            <li class="">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
            <li class="">Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</li>
            <li class="">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</li>
            <li class="">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
        </ul>

           
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
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