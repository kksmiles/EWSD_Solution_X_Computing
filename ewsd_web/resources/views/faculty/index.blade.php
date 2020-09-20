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
<table>
  <caption>
    Faculty
    <a href="{{route('faculty.add')}}">
       <button>Add New</button>
    </a>
 
  </caption>
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Faculty Name</th>
      <th scope="col">About</th>
      <th scope="col">Established At</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($faculties as $key => $faculty)
        <tr>
        <td>{{$key+1}}</td>
        <td>{{$faculty->name}}</td>
        <td>{{$faculty->description}}</td>
        <td>{{$faculty->created_at}}</td>
        <td>
            <a href="{{route('faculty.edit',$faculty->id)}}">
                <button>Edit</button>
            </a>
            <a href="{{route('faculty.delete',$faculty->id)}}">
                <button>Delete</button>
            </a>
        </td>
        </tr>
    @endforeach
  </tbody>
</table>
</body>
</html> 