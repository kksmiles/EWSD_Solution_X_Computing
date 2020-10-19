<style>
  body {
    font-family: "Open Sans", sans-serif;
    line-height: 1.25;
  }

  table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    width: 800px;
    margin: 50px auto;
    table-layout: fixed;
  }

  table caption {
    font-size: 1.5em;
    margin: .5em 0 .75em;
  }

  table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: .35em;
  }

  table th,
  table td {
    padding: .625em;
    text-align: center;
  }

  table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
  }

  @media screen and (max-width: 600px) {
    table {
      border: 0;
    }

    table caption {
      font-size: 1.3em;
    }
    
    table thead {
      border: none;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
    }
    
    table tr {
      border-bottom: 3px solid #ddd;
      display: block;
      margin-bottom: .625em;
    }
    
    table td {
      border-bottom: 1px solid #ddd;
      display: block;
      font-size: .8em;
      text-align: right;
    }
    
    table td::before {
      /*
      * aria-label has no advantage, it won't be read inside a table
      content: attr(aria-label);
      */
      content: attr(data-label);
      float: left;
      font-weight: bold;
      text-transform: uppercase;
    }
    
    table td:last-child {
      border-bottom: 0;
    }
  }
</style>
<body>
  @if ($message = Session::get('success'))
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <div style="margin:0 auto; text-align:center; background:green; color:#fff;">
        <h1>Exceptional Report (Contribution without Comments)</h1>
  </div>
    <form action="" method="POST">
    @csrf
        <div style="margin:0 auto; text-align:center; width: 600px; display:flex;">
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
  <table>
    <thead>
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
                        <button style="color:green;">Download Files</button>
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
</body