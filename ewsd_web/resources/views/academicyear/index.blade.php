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
            <a href="{{ route('academicyears.show', $academic_year->id) }}">{{ $academic_year->title }}</a>
            <a href="{{ route('academicyears.edit', $academic_year->id) }}">Edit</a>
            <form action="{{ route('academicyears.destroy', $academic_year->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>   
            </form>
        </li>    
    @endforeach
    <br>
    <a href="{{ route('academicyears.create') }}">Create</a>
    <br>
    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif    
</body>
</html>