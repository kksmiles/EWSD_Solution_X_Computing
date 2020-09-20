<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academic Years List</title>
</head>
<body>
    @foreach($academic_years as $academic_year)
        <li>
            <a href="/academicyears/{{ $academic_year->id }}">{{ $academic_year->title }}</a>
            <a href="/academicyears/{{ $academic_year->id }}/edit">Edit</a>
            <form action="/academicyears/{{ $academic_year->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>   
            </form>
        </li>    
    @endforeach
    <br>
    <a href="/academicyears/create">Create</a>
</body>
</html>