@extends('template')

@section('content')
<section class='container'>

    <div class="card border-left-primary rounded-lg shadow p-3 rounded-lg m-2">
        <h5 class="font-weight-bold p-2 text-dark">Magazine Issues</h5>
        <form action="{{ route('magazine-issues.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
          <div class="row col-12">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'> Associated Faculty : </label>
                <select name="faculty_id" class="form-control border-dark rounded-lg">
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Academic year : </label>
                <select name="academic_year_id" class="form-control border-dark rounded-lg">
                    @foreach($academic_years as $academic_year)
                        <option value="{{ $academic_year->id }}">{{ $academic_year->title }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Staff in charge : </label>
                <select name="staff_id" class="form-control border-dark rounded-lg">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->fullname }}</option>
                    @endforeach 
                </select>
              </div>

              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Title :</label>
                <input type="text" name="title" id="firl" class="form-control border-dark rounded-lg" required>
              </div>
            </div>

            <div class="col-md-6 col-xs-12">
              <div class="form-group">
              <div class="form-group">
                <label for="" class='form-check-label font-weight-normal'>Description : </label>
                <textarea class="form-control border-dark" name="description" required=""></textarea>
              </div>

                <div class="form-group">
                  <label for="" class='form-check-label font-weight-normal'> Submission Closure Date : </label>
                  <input type="date" name="submission_closure_date" id="firl" class="form-control border-dark rounded-lg" required>
                </div>

                <div class="form-group">
                  <label for="" class='form-check-label font-weight-normal'>Modification Closure Date :</label>
                  <input type="date" name="modification_closure_date" id="firl" class="form-control border-dark rounded-lg" required>
                </div>
                
                  <label for="image" class='form-check-label font-weight-normal btn btn-dark text-white'> <span class="fa fa-images"></span>&nbsp;Choose Image :</label>
                  <input type="file" name="image" class="d-none form-control border-dark border-0 rounded-lg" id="image">

                  <label for="file" class='form-check-label font-weight-normal mt-2 mt-md-0 btn btn-dark text-white'> <span class="fa fa-folder"></span>&nbsp;Choose File :</label>
                  <input type="file" name="file"  class="d-none form-control border-dark border-0 rounded-lg" id="file">
              </div>
             
              </div>
                
                <div class="col-12 pt-md-5">
                <button type="submit" class="btn btn-primary button float-md-right">Create Magazine Issue</button>   
                </div>


            </div>
          </div>

         
        </form>
      </div>

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

</section>
@endsection