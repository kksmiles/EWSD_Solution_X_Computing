@extends('template')
@section('content')
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


   google.charts.load('current', {'packages':['corechart']});

   google.charts.setOnLoadCallback(drawChart);
   google.charts.setOnLoadCallback(drawChartUsers);
   google.charts.setOnLoadCallback(drawChartConFaculty);
   google.charts.setOnLoadCallback(drawChartConMonthAndYearly);
   google.charts.setOnLoadCallback(drawChartNumbersOfStudents);
   google.charts.setOnLoadCallback(drawChartNumbersOfContributors);

   function drawChart()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['contributions']; ?>);
    var options = {
     title : 'Percentage of Published and Unpublished Contributions of year',
     is3D: true,
    };
    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
    chart.draw(data, options);
   }
   function drawChartUsers()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['users']; ?>);
    var options = {
     title : 'Percentage of Application Users',
     is3D: true,
    };
    var chart = new google.visualization.PieChart(document.getElementById('user_chart'));
    chart.draw(data, options);
   }
   function drawChartConFaculty()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['contributions_faculty']; ?>);

    var options = {
     title : 'Percentage of Selected Contributions of each Faculty',
     is3D: true,
    };
    var chart = new google.visualization.BarChart(document.getElementById('contri_faculty_chart'));
    chart.draw(data, options);
   }

   function drawChartConMonthAndYearly()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['contributions_month&yearly']; ?>);

    var options = {
     title : 'Percentage of Contributions Months And Yearly Graph',
     is3D: true,
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('contri_month_year'));
    chart.draw(data, options);
   }

   function drawChartNumbersOfStudents()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['students']; ?>);

    var options = {
     title : 'Number of Students within each Faculty',
     is3D: true,
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('num_students'));
    chart.draw(data, options);
   }

   function drawChartNumbersOfContributors()
   {
    var data = google.visualization.arrayToDataTable(<?php echo $datas['contributors']; ?>);

    var options = {
     title : 'Number of Contributors within each Faculty',
     is3D: true,
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('num_contributors'));
    chart.draw(data, options);
   }
   </script>
<section class="container">
    <h3 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">                
        Report Statistics Chart
        <a href="{{route('manager.charts.contribute','2021')}}">
            <button class="btn btn-sm btn-info">
                2021
            </button> 
        </a>
        <a href="{{route('manager.charts.contribute','2020')}}">
            <button class="btn btn-sm btn-info">
                    2020
            </button> 
        </a>
        <a href="{{route('manager.charts.contribute','2019')}}">
            <button class="btn btn-sm btn-info">
                    2019
            </button> 
        </a>
    </h3>
    <div class="row">
        <div class="col-lg-6 col-12">            
            <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Percentage of Male and Female Employee</h5>
            <div id="pie_chart">
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Percentage of Application Users</h5>
            <div id="user_chart">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">    
            <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Percentage of Selected Contributions of each Faculty</h5>
            <div id="contri_faculty_chart">
            </div>
        </div>

        <div class="col-lg-6 col-12">    
            <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Percentage of Contributions Months And Yearly Graph</h5>
            <div id="contri_month_year">
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-12">
        <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Number of students within each Faculty</h5>
        <div id="num_students">
        </div>
    </div>

    <div class="col-lg-12 col-12">
        <h5 class="d-inline-block py-2 font-weight-bold rounded-lg text-primary">Number of Contributors within each Faculty</h5>
        <div id="num_contributors">
        </div>
    </div>
</section>
@endsection