<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academic Years List</title>
</head>
<body>
    @foreach($magazine_issues as $magazine_issue)
        <li>
            <a href="{{ route('magazine-issues.show', $magazine_issue->id) }}">{{ $magazine_issue->title }}</a>
            <a href="{{ route('magazine-issues.edit', $magazine_issue->id) }}">Edit</a>
            <form action="{{ route('magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>   
            </form>
        </li>    
    @endforeach
    <br>
    <a href="{{ route('magazine-issues.create') }}">Create</a>
    <br>
    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif    
</body>
</html>