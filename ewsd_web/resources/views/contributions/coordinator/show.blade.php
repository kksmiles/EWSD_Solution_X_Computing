

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academic Years List</title>
</head>
<style>
body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  width: 100%;
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

@if(isset($getContributions))
<div style="margin:10px auto; text-align:center">
    <h1>
        {{$issue->title}}
        <a href="{{route('contribution.coordinator.index')}}">
            <button>Back to issues</button>
        </a>
    </h1>
    <p>
        {{$issue->description}}
    </p>
    <hr>
</div>
<table>
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Contribution Name</th>
      <th>Description</th>
      <th>Student Name</th>
      <th>Uploaded Date</th>
      <th>File</th>
      <th>Status</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
    @foreach($getContributions as $key => $contribution)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$contribution->title}}</td>
            <td>{{$contribution->description}}</td>
            <td>{{$contribution->student()->first()->fullname}}</td>
            <td>{{$contribution->created_at}}</td>
            <td>
                <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
                <button>Download Files</button>
                </a>
            </td>
            <td style="display:flex">
                @if($contribution->is_published == '0')
                <form action="{{ route('contribution.coordinator.publish',$contribution->id) }}" method="POST">
                    @csrf
                    <button>Publish</button>
                </form>
                <form action="{{ route('contribution.coordinator.reject',$contribution->id) }}" method="POST">
                    @csrf
                    <button style="margin-left:10px;">Reject</button>
                </form>
                @else
                    @if( $contribution->is_published == '1')
                        <span style="background: green; color: #fff;">Published</span>
                    @else
                        <span style="background: red; color: #fff;">Rejected Manually</span>
                    @endif
                @endif
            </td>
            <td>
                <button style=""> Give Comment</button>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
@else
    <div style="margin:10px auto; text-align:center">
        There is no contributions in this issue
        <a href="{{route('contribution.coordinator.index')}}">
            <button>Back to issues</button>
        </a>
    </div>
@endif
</body>
</html> 