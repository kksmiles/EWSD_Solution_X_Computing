<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <h1>Student Upload Contributions 
        <a href="{{route('contribution.student.all')}}">
            <button>Show My Contributions</button>
        </a>
    </h1>
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
    <form action="{{ route('contribution.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Choose Magazines Issues of Your Faculties:
        <select name="issueId">
            @foreach($availableMagazineIssuesWithFaculty as $issue)
                <option value="{{ $issue->id }}">{{ $issue->title }}</option>
            @endforeach
        </select>
        <br>
        Student name => <span style="color: blue; font-size: 20px;">{{\Auth::user()->fullname}}</span>
       <br>
        Title : <input type="text" name="title" >
        <br>
        Description : <input type="text" name="description" >
        <br>
        <br>
        File : <input type="file" name="file"> <br>
        <br>
        <input type="checkbox" id="checkTerm"> Agree terms and conditions of this issue
        <br>
        <button type="submit" id="submitBtn" disabled>Upload Contributions</button>
    </form>

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
</body>
</html>
