@extends('template')
@section('content')

<section class='container'>

    <form action="{{ route('magazine-issues.update', $magazine_issue->id) }}" method="POST" enctype="multipart/form-data" class='col-6'>
        @csrf
        @method('PATCH')
        Associated Faculty : 
        <select name="faculty_id" class='form-control'>
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
        <select name="academic_year_id" class='form-control'>
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
        <select name="staff_id" class='form-control'>
            @foreach($staffs as $staff)
                <option value="{{ $staff->id }}">{{ $staff->fullname }}</option>
            @endforeach
        </select>
        <br>
        Title : <input type="text" name="title" value="{{ $magazine_issue->title }}" class='form-control' required>
        <br>
        Description : <input type="text" name="description" value="{{ $magazine_issue->description }}" class='form-control' required>
        <br>
        Submission Closure Date : <input type="date" name="submission_closure_date" value="{{ $magazine_issue->submission_closure_date }}" class='form-control' required>
        <br>
        Modification Closure Date : <input type="date" name="modification_closure_date" value="{{ $magazine_issue->modification_closure_date }}" class='form-control' required>
        <br>
        Image : <input type="file" name="image" class='form-control' > <br>
        File : <input type="file" name="file"class='form-control' > <br>
        <button type="submit" class='btn btn-primary'>Save</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</section>
@endsection