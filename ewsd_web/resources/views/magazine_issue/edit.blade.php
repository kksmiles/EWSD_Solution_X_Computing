@extends('template')
@section('content')

<section class='container'>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                <strong>{{ $error }}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    <div class="card border-left-primary rounded-lg shadow p-3 rounded-lg m-2">
        <h5 class="font-weight-bold p-2 text-dark">
            {{$magazine_issue->title}} 
            <a href="{{ route('magazine-issues.index')}}" class="btn btn-primary button float-md-right">
                Back
            </a>
        </h5>
        <form action="{{ route('magazine-issues.update', $magazine_issue->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PATCH')
          <div class="row col-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'> Associated Faculty : </label>
                <select name="faculty_id" class="form-control border-dark rounded-lg">
             
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
                <label for="" class='form-check-label font-weight-normal'>Academic year : </label>
                <select name="academic_year_id" class="form-control border-dark rounded-lg">
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

              <input type="hidden" value="{{ Auth::user()->id }}" name="staff_id">

              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Title :</label>
                <input type="text" name="title" value="{{ $magazine_issue->title }}" id="firl" class="form-control border-dark rounded-lg" required>
              </div>
            </div>

            <div class="col-md-6 col-xs-12">
              <div class="form-group">
              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Description : </label>
                <textarea class="form-control border-dark" name="description" required="">{{ $magazine_issue->description }}</textarea>

              </div>

                <div class="form-group">
                  <label for="" class='form-check-label font-weight-normal'> Submission Closure Date : </label>
                  <input type="date" name="submission_closure_date" value="{{ $magazine_issue->submission_closure_date }}" id="firl" class="form-control border-dark rounded-lg" required>
                </div>

                <div class="form-group">
                  <label for="" class='form-check-label font-weight-normal'>Modification Closure Date :</label>
                  <input type="date" name="modification_closure_date" value="{{ $magazine_issue->modification_closure_date }}" id="firl" class="form-control border-dark rounded-lg" required>
                </div>
                
                  <label for="image" class='form-check-label font-weight-normal btn btn-dark text-white'> <span class="fa fa-images"></span>&nbsp;Choose Image :</label>
                  <input type="file" name="image" class="d-none form-control border-dark border-0 rounded-lg" id="image">

                  <label for="file" class='form-check-label font-weight-normal mt-2 mt-md-0 btn btn-dark text-white'> <span class="fa fa-folder"></span>&nbsp;Choose File :</label>
                  <input type="file" name="file"  class="d-none form-control border-dark border-0 rounded-lg" id="file">
              </div>
             
              </div>
                
                <div class="col-12 pt-md-5">
                    <button type="submit" class="btn btn-primary button float-md-right">Update</button>   
                </div>


            </div>
          </div>

         
        </form>
      </div>
      

</section>
@endsection