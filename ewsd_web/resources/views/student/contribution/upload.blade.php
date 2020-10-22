@extends('template')
@section('content')

<section class="container">
        
       <div class="p-2">
            <a href="{{route('contribution.student.all')}}" class="btn btn-outline-primary">
                Show My Contributions
            </a>
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

        <form action="{{ route('contribution.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <span class="form-control-label">Choose Magazines Issues of Your Faculties:</span>
                <select name="issueId" class="form-control">
                    @foreach($availableMagazineIssuesWithFaculty as $issue)
                        <option value="{{ $issue->id }}"
                            @if(session('issue-id')==$issue->id)
                                selected
                            @endif
                        >
                            {{ $issue->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                Student name - <span class="text-dark font-weight-bold">{{\Auth::user()->fullname}}</span>
            </div>

            <div class="form-group">
                <span class="form-group">Title</span>
                <input type="text" class="form-control" name="title" >
            </div>

            <div class="form-group">
                <span class="form-group">Description</span>
                <textarea class="form-control" name="description"></textarea>     
            </div>

            <div class="form-group">
                <span class="form-group">File</span>
                <input type="file" class="form-control" name="file" >
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