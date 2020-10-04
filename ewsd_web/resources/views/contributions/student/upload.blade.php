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
        <br>
        <button type="submit">Upload Contributions</button>
    </form>

</body>
</html>
