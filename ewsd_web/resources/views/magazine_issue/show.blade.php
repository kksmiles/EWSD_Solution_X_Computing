@extends('template')

@section('css')

@endsection
 

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="app.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href="{{ URL::asset('css/hpmcss.css')}}" rel="stylesheet">
    <title>Edit Contribution</title>
  
</head>
<body id="page-top">
 <!-- Page Wrapper -->
 <div id="wrapper">


<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">
<div class="bg-1 container">

<div class="container card shadow p-3 rounded-lg m-2">
    <div class="contri">
<h3 class="head" align="center">"  {{strtoupper($magazine_issue->title)}} "</h3><br>
<h5>Title : {{ $magazine_issue->title }}</h5>
<p class="para">Description : {{ $magazine_issue->description }}</p>
<p>Academic Year: {{ $magazine_issue->academic_year->title }}</p>
<p>Associated Faculty : {{ $magazine_issue->faculty->name }}</p>
<p>Duty Coordinator : {{ $magazine_issue->staff->fullname }}</p>
<a href="{{asset($magazine_issue->file)}}" download="{{$magazine_issue->file}}" class="btn btn-success mb-5" >
           Download This Magazine Issue
</a>
<br>
<span class="badge badge-primary">Start Date: {{ $magazine_issue->created_at }}</span>&nbsp;&nbsp;
<span class="badge badge-danger">Submission Deadline: {{ $magazine_issue->submission_closure_date }}</span>&nbsp;&nbsp;
<span class="badge badge-success">Modify Deadline: {{ $magazine_issue->modification_closure_date }}</span>&nbsp;&nbsp;


</div></div>
<br><br>
<div class="status">
<h5 class="head">Submission Status</h5><hr><br>
<table class="table table-dark">
    <tr>
        <td>
            Submission Status
        </td>
        <td>
            Submitted
        </td>
    </tr>
   
    <tr>
        <td>
            Submission Deadline
        </td>
        <td>
        {{ $magazine_issue->submission_closure_date }}
        </td>
    </tr>
    <tr>
    <td>
        Modified Deadline</td>
    <td>{{ $magazine_issue->modification_closure_date }}</td>

    </tr>
    <tr>
     <td>Acedemic Year</td>
     <td>{{ $magazine_issue->academic_year->title }}</td>
    </tr>
    <td>Last modified</td>
    <td>{{ $magazine_issue->updated_at }}</td>
    <tr>
    <td>Associated Faculty</td>
    <td>{{ $magazine_issue->faculty->name }}</td>
    </tr>
    <tr>
    <td>Duty Coordinator</td>
    <td>{{ $magazine_issue->staff->fullname }}</td>
    </tr>
    @if(Gate::allows('isStudent'))
    <tr>
    <td>Your Contributions</td>
    <td><a href="{{ route('student.magazine-issues.contributions', $magazine_issue->id) }}">Your Contributions </a></td>
    </tr>
     @elseif(Gate::allows('isMarketingCoordinator'))
    <tr>
    <td>Check This issue's Contributions</td>
    <td><a href="{{ route('coordinator.magazine-issues.contributions.show', $magazine_issue->id) }}">Check Contributions </a></td>
    </tr>
    @elseif(Gate::allows('isMarketingManager'))
    <tr>
    <td>Check This issue's Contributions</td>
    <td><a href="{{ route('manager.magazine-issues.contributions', $magazine_issue->id) }}">Check Contributions </a></td>
    </tr>
    @endif
</table>
<br>
    <div class='col-12' style="width:400px;">
        <a href="{{ route('magazine-issues.index')}}" class="btn btn-primary button mb-5">
                Back
            </a>
    </div>
</div>
</div>

</div>

</div>
</div>
</div>
</body>

@endsection