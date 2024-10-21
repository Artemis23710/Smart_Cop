@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.investigation_navbar')
    </div>
</div>

<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form  id="searchForm" action="{{ route('analizecrime') }}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="inputlabel">Search Area</label>
                            <input type="text" class="form-control" id="searcharea" name="searcharea" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group required">
                            <label class="inputlabel">Date Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" class="form-control" id="fromdate" name="fromdate" required>
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control" id="todate" name="todate" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 ">
                        <div class="form-group">
                            <label class="inputlabel">Main Crime Category</label><br>
                                <select class="selectpicker" data-style="select-with-transition"title="Choose Main Crime Category" name="maincrime" id="maincrime">
                                    @foreach($maincrimecategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->main_crime_category}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-3 ">
                        <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info" style="margin-top:30px;"><i class="fas fa-search"></i>&nbsp;Search</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body" id="analizercard" >
                <div id="chart_div" style="width:100%;"></div><br><br>
                <table id="crimeStatsTable" class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>Crime Category</th>
                            <th>Crime Count</th>
                            <th>Percentage (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')

<script>
     google.charts.load('current', {
         'packages': ['corechart']
     });

     $(document).ready(function () {
        $("#crimeanalizelink").addClass('active');

        $('#searchForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            console.log('Success:', response);
            $('#crimeStatsTable tbody').empty();

            if (response.crime_stats.length > 0) {
                $.each(response.crime_stats, function (index, crime) {
                    let row = `<tr>
                        <td>${crime.main_crime_category}</td>
                        <td>${crime.crime_count}</td>
                        <td>${crime.percentage}%</td></tr>`;
                    $('#crimeStatsTable tbody').append(row);
                });

                var chartData = [
                    ['Crime Category', 'Crime Percentage']
                ];
                var colors = []; 

                $.each(response.crime_stats, function (index, crime) {
                    chartData.push([crime.main_crime_category, crime.crime_count]);
                    colors.push('#' + Math.floor(Math.random() * 16777215).toString(16)); 
                });
                drawChart(chartData, colors); 

               

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Not Found',
                    text: 'No Matching Record in the Database',
                    showConfirmButton: false,
                    position: "top-end",
                    timer: 1000
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while processing the request.');
        }
    });
});


    });

    function drawChart(chartData, colors) {
    var data = google.visualization.arrayToDataTable(chartData);

    var options = {
        title: 'Crime Statistics',
        hAxis: { title: 'Crime Percentage' },
        vAxis: { title: 'Crime Category' },
        legend: 'none',
        series: {}
    };

    for (var i = 0; i < colors.length; i++) {
        options.series[i] = { color: colors[i] };
    }

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}


</script>    
@endsection