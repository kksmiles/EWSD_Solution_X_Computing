@extends('template')
@section('content')

<section class='container'>
    <div class="card border-left-primary p-3">
        
        <form action="{{ route('magazine-issues.update', $magazine_issue->id) }}" method="POST" enctype="multipart/form-data" class='row'>
            @csrf
            @method('PATCH')
            <div class="col-6">
                <div class="form-group">
                    <span class="form-control-label">Associated Faculty : </span>     
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
                    
                </div>

                <div class="form-group">
                    <span class="form-control-label">Academic year : </span>
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
                </div>

                <div class="form-group">
                    <span class="form-control-label">Staff in charge :</span>
                    <select name="staff_id" class='form-control'>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->fullname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <span class="form-control-label">Title :</span>
                    <input type="text" name="title" value="{{ $magazine_issue->title }}" class='form-control' required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <span class="form-control-label">Description</span>
                    <input type="text" name="description" value="{{ $magazine_issue->description }}" class='form-control' required>
                </div>
                <div class="form-group">
                    <span class="form-control-label">Submission Closure Date</span>
                    <input type="date" name="submission_closure_date" value="{{ $magazine_issue->submission_closure_date }}" class='form-control' required>
                </div>
                
                <div class="form-group">
                    <span class="form-control-label">Modification Closure Date</span>
                    <input type="date" name="modification_closure_date" value="{{ $magazine_issue->modification_closure_date }}" class='form-control' required>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <span class="form-control-label">Image</span>
                        <input type="file" name="image" class='form-control' >
                    </div>
                    <div class="col-6">
                        <span class="form-control-label">File</span>
                        <input type="file" name="file"class='form-control' >                        
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class='btn btn-primary'>Store</button>
                    <a href="{{ route('magazine-issues.index') }}" class='btn btn-warning'>Back</a>
                </div>
            </div>
           
          
        </form>
        
    </div>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</section>
@endsection