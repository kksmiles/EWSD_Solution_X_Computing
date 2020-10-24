@extends('template')
@section('content')
<section>
    <div class="container p-3">
        @if ($message = Session::get('success'))
            <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <h5 class=" d-inline-block py-2 font-weight-bold rounded-lg text-primary">                
            Contribution Reports
        </h5>
        <div class="container card p-3 border-left-primary">
            <form action="" method="POST" class="form-inline p-0 keep-resize">
                @csrf
                <div class="form-group">
                    <div style="margin: 5px;">
                        Acedemic Years:
                        <select name="academic_year" class="form-control">
                            <option value="all" {{ $acedemicYear == 'all' ? "selected" : '' }}> 
                                All
                            </option>
                            @foreach($academics_years as $key => $academics)
                                <option value="{{$academics->id}}" {{ $acedemicYear == $academics->id ? "selected" : '' }}> 
                                    {{$academics->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin: 5px;">
                        Faculty:
                        <select name="faculty" class="form-control">
                            <option value="all" {{ $facultyId == 'all' ? "selected" : '' }}> 
                                All
                            </option>
                            @foreach($faculties as $key => $faculty)
                                <option value="{{$faculty->id}}" {{ $facultyId == $faculty->id ? "selected" : '' }}> 
                                    {{$faculty->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin: 5px;">
                        Status:
                        <select name="status" class="form-control">
                            <option value="all" {{ $status == 'all' ? "selected" : '' }}> 
                                All
                            </option>
                            <option value="1" {{ $status == '1' ? "selected" : '' }}>Published Contributions</option>
                            <option value="0" {{ $status == '0' ? "selected" : '' }}>Pending Contributions</option>
                            <option value="2" {{ $status == '2' ? "selected" : '' }}>Rejected Contributions</option>
                        </select>
                    </div>
                    <div style="margin: 5px;">
                        <button type="submit" class="btn btn-sm btn-success">Search Filter</button>
                    </div>
                </div>
            </form>
                <table class="table table-responsive d-md-table" id="table-resize-collapse">
                    <thead class="bg-dark-primary text-white">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Contribution</th>
                        <th scope="col">Issue</th>
                        <th scope="col">Academic Year</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Status</th>
                        <th scope="col">Download File</th>
                    </tr>
                    </thead>
                <tbody>
                @foreach($contributions as $key => $contribution)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$contribution->contribution_title}}</td>
                    <td>{{$contribution->magazine_issues_title}}</td>
                    <td>{{$contribution->academic_year_title}}</td>
                    <td>{{$contribution->faculty_name}}</td>
                    <td>{{$contribution->contribution_status == '0' ? 'Pending' : $contribution->contribution_status == '1' ? 'Published' : 'Rejected'}}</td>
                    <td>
                        @if($contribution->contribution_status == '1')
                            <a href="{{asset('storage/contributions/'.$contribution->contribution_download_file)}}" download="{{$contribution->contribution_download_file}}">
                                <button  class="btn btn-sm btn-info">Download Files</button>
                            </a>
                        @else
                            @if($contribution->contribution_status == '0')
                                <span style="color: black;">Pending File</span>
                            @else
                                <span style="color: red;">Rejected File</span>
                            @endif
                        @endif
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>   
    </div>
  
</section>
@endsection