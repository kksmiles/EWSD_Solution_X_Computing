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
          Exceptional Report (Contribution without Comments)
        </h5>
        <div class="container card p-3 border-left-primary">
          <form action="" method="POST" class="form-inline p-0 keep-resize">
            @csrf
                <div class="form-group">
                    <div style="margin: 5px;">
                        Acedemic Years:
                        <select name="academic_year">
                            <option value="all"  {{ $acedemicYear == 'all' ? "selected" : '' }}> 
                                    All
                            </option>
                            @foreach($academics_years as $key => $academics)
                                <option value="{{$academics->id}}"  {{ $acedemicYear == $academics->id ? "selected" : '' }}> 
                                    {{$academics->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin: 5px;">
                        <button type="submit">Search Filter</button>
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
                    <td>{{$contribution->contribution_status == '0' ? 'Pending' : $contribution->contribution_status == '1' ? 'Published' : 'Rejected'}}</td>
                    <td>
                        @if($contribution->contribution_status == '1')
                            <a href="{{asset('storage/contributions/'.$contribution->contribution_download_file)}}" download="{{$contribution->contribution_download_file}}">
                                <button class="btn btn-sm btn-info"">Download Files</button>
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