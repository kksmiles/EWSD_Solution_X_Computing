
<body>
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif
    <form action="" method="POST">
    @csrf
        <div style="margin:0 auto; text-align:center; width: 600px; display:flex;">
            <div style="margin: 5px;">
                Acedemic Years:
                <select name="academic_year">
                    @foreach($academics_years as $key => $academics)
                        <option value="{{$academics->id}}" {{ $acedemicYear == $academics->id ? "selected" : '' }}> 
                            {{$academics->title}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="margin: 5px;">
                Status:
                <select name="status">
                    <option value="1" {{ $status == '1' ? "selected" : '' }}>Published Contributions</option>
                    <option value="0" {{ $status == '0' ? "selected" : '' }}>Pending Contributions</option>
                    <option value="2" {{ $status == '2' ? "selected" : '' }}>Rejected Contributions</option>
                </select>
            </div>
            <div style="margin: 5px;">
                <button type="submit">Search Filter</button>
            </div>
        </div>
    </form>
  <table>
    <thead>
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
            <td>{{$contribution->contribution_status}}</td>
            <td>{{$contribution->contribution_download_file}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</body