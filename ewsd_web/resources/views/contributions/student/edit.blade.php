<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <h1>
        Updated of {{$contributions->title}}
        <a href="{{route('contribution.student.all')}}">
            <button>back</button>
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
    @if ($message = Session::get('fail'))
        <div style="margin:0 auto; text-align:center; background:red; color:#fff;">
                <strong>{{ $message }}</strong>
        </div>
    @endif 

    <form action="{{ route('contribution.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$contributions->id}}" name="id">
        Choose Magazines Issues
        <select name="issueId">
            @foreach($availableMagazineIssuesWithFaculty as $issue)
                <option value="{{ $issue->id }}" <?php echo $contributions->issue_id == $issue->id ? 'selected' : 'sfd' ?> >{{ $issue->title }}</option>
            @endforeach
        </select>
        <br>
        Student name => <span style="color: blue; font-size: 20px;">{{\Auth::user()->fullname}}</span>
       <br>
        Title : <input type="text" name="title" value="{{$contributions->title}}" >
        <br>
        Description : <input type="text" name="description" value="{{$contributions->description}}">
        <br>
        <br>
        File : <input type="file" name="file"> <br>
        <br>
        <input type="checkbox" id="checkTerm"> <label for="checkTerm">Agree terms and conditions of this issue</label> 
        <br>
        <button type="submit" id="submitBtn" disabled>Update</button>
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
