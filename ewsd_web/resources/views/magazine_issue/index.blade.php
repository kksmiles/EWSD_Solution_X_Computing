@extends('template')
@section('content')
    <section class='container'>
        {{-- <h4>{{$user_faculties[0]->name}}</h4> --}}
        {{-- <form class="form-inline" action="{{route('user_faculty.select')}}">
          <div class="form-group mb-2">
            <label for="faculty_name">Select Faculty : </label>
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <select class="form-control" name="faculty_id">
              @foreach ($user_faculties as $faculty)
              <option value="{{$faculty->id}}">{{$faculty->name}}</option>
              @endforeach     
            </select>
          </div>
          <button type="submit" class="btn btn-primary mb-2">Confirm</button>
        </form> --}}
        @foreach($magazine_issues as $magazine_issue)
            <div class='row border p-2 m-1'>
                @if(Gate::allows('isStudent'))
                    <div class='col-3'>
                        <a href="{{ route('student.magazine-issues.show', $magazine_issue->id) }}" >{{ $magazine_issue->title }}</a>
                    </div>
                @elseif(Gate::allows('isMarketingCoordinator'))
                    <div class='col-3'> 
                        <a href="{{ route('coordinator.magazine-issues.show', $magazine_issue->id) }}" >{{ $magazine_issue->title }}</a>    
                    </div>
                    <div class='col-3'>
                        <a href="{{ route('coordinator.magazine-issues.edit', $magazine_issue->id) }}" class='btn btn-primary'>Edit</a>
                    </div>
                    <div class='col-3'>
                        <form action="{{ route('coordinator.magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-danger'>Delete</button>   
                        </form>
                    </div>
                @else
                <div class='col-3'> 
                    <a href="{{ route('magazine-issues.show', $magazine_issue->id) }}" >{{ $magazine_issue->title }}</a>    
                </div>
                <div class='col-3'>
                    <a href="{{ route('magazine-issues.edit', $magazine_issue->id) }}" class='btn btn-primary'>Edit</a>
                </div>
                <div class='col-3'>
                    <form action="{{ route('magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class='btn btn-danger'>Delete</button>   
                    </form>
                </div>
                @endif
            </div>
        @endforeach



        @if(Gate::allows('isMarketingCoordinator'))
        <br>
            <a href="{{ route('coordinator.magazine-issues.create') }}" class='btn btn-primary'>Create</a>
        <br>
        @endif
        @if ($message = Session::get('success'))
            <strong>{{ $message }}</strong>
        @endif    
    </section>
@endsection