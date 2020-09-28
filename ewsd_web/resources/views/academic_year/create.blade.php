<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academic Year Create Form</title>
</head>
<body>
    <form action="{{ route('academic-years.store') }}" method="POST">
        @csrf
        Title : <input type="text" name="title" required>
        <br>
        Description : <input type="text" name="description" required>
        <br>
        Closure Date : <input type="date" name="closure_date" required>
        <button type="submit">Save</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
