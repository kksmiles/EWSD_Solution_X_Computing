<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magazine Issue Create Form</title>
</head>
<body>
    <form action="{{ route('magazine-issues.update', $magazine_issue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        Associated Faculty : 
        <select name="faculty_id">
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}" 
                    @if($faculty->id == $magazine_issue->faculty_id)
                        selected
                    @endif
                    >
                    {{ $faculty->name }}
                </option>
            @endforeach
        </select>
        <br>
        Academic year : 
        <select name="academic_year_id">
            @foreach($academic_years as $academic_year)
                <option value="{{ $academic_year->id }}"
                    @if($academic_year->id == $magazine_issue->academic_year_id)
                        selected
                    @endif
                    >
                    {{ $academic_year->title }}
                </option>
            @endforeach
        </select>
        <br>
        Staff in charge : 
        <select name="staff_id">
            @foreach($staffs as $staff)
                <option value="{{ $staff->id }}">{{ $staff->fullname }}</option>
            @endforeach
        </select>
        <br>
        Title : <input type="text" name="title" value="{{ $magazine_issue->title }}" required>
        <br>
        Description : <input type="text" name="description" value="{{ $magazine_issue->description }}" required>
        <br>
        Submission Closure Date : <input type="date" name="submission_closure_date" value="{{ $magazine_issue->submission_closure_date }}" required>
        <br>
        Modification Closure Date : <input type="date" name="modification_closure_date" value="{{ $magazine_issue->modification_closure_date }}" required>
        <br>
        Image : <input type="file" name="image"> <br>
        File : <input type="file" name="file"> <br>
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
