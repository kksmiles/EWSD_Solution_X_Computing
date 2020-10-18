<!DOCTYPE html>
<html>
 <head>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <style type="text/css">
   .box{
    width:800px;
    margin:0 auto;
   }
  </style>

  <script type="text/javascript">


   google.charts.load('current', {'packages':['corechart']});

   google.charts.setOnLoadCallback(drawChart);
   google.charts.setOnLoadCallback(drawChartUsers);
   google.charts.setOnLoadCallback(drawChartConFaculty);

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
    var chart = new google.visualization.AreaChart(document.getElementById('contri_faculty_chart'));
    chart.draw(data, options);
   }
  </script>
  <style>
        /* Create two equal columns that floats next to each other */
        .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: auto; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
</style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">
    Report Statistics Chart
    <a href="{{route('charts.contribute','2021')}}">
                <button>
                    2021
                </button> 
    </a>
    <a href="{{route('charts.contribute','2020')}}">
            <button>
                2020
            </button> 
    </a>
    <a href="{{route('charts.contribute','2019')}}">
            <button>
                2019
            </button> 
    </a>
   </h3><br />
   <div class="row">
        <div class="column" style="background-color:#aaa;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Percentage of Male and Female Employee</h3>
                    <div id="pie_chart" style="width:500px; height: 300px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="column" style="background-color:#bbb;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Percentage of Application Users</h3>
                    <div id="user_chart" style="width:500px; height: 300px; ">
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="panel panel-default" align="center">
        <div class="panel-heading">
            <h3 class="panel-title">Percentage of Selected Contributions of each Faculty</h3>
            <div id="contri_faculty_chart" style="width:750px; height:500px;">
            </div>
        </div>
  </div>

 </body>
</html>