@extends('layouts.index_template')
@section('content')
<div class="page-body">
    <div class="container-xl">
      
        <style>
          .chart-title {
            font-family: Cambria, serif; 
            font-size: 1.8rem; /* Adjust font size */
            font-weight: bold; /* Bold text */
            color: #333; /* Title color */
            margin-bottom: 7px; /* Space between the title and chart */
            text-align: left; /* Align text to the left */
            margin-left: 1px; /* Adjust this value to move it further left */
        }
            body {
                background: #f3e8f7; /* Light purple background color */
            }
            .card {
                text-align: center;
                padding: 20px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                margin: 10px auto;
            }
            .h1 {
                font-size: 3rem;
            }
            .chart-container {
                max-width: 500px; /* Limit the size of the chart */
                margin: 0 auto;
            }
            .row-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
            }
            .counts-container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 20px;
                flex: 1; /* Ensure it takes equal space */
            }
            .chart-wrapper {
                flex: 1; /* Ensure it takes equal space */
            }
        </style>

        <div class="page-body">
            <div class="container-xl">
              
            <div class="chart-section text-center">
            <!-- Title for the Chart -->
            <h1 class="chart-title"><b>GRANT MANAGEMENT SYSTEM PIE CHART</b></h1>
                <div class="row-container">
                    <!-- Chart on the left -->
                    <div class="chart-wrapper">
                        <div class="chart-container">
                            <canvas id="overviewChart"></canvas>
                        </div>
                    </div>

                    <!-- Statistic Cards on the right -->
<div class="counts-container">
    <div class="col-lg-12">
        <div class="card" style="width: 100%; max-width: 400px; margin: 0 auto;">
            <div class="card-body text-center">
                <div class="header"><b>Academicians</b></div>
                <p></p>
                <div class="h1 mb-3">{{ $academiciansCount }}</div>
                <div>Total Count</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card" style="width: 100%; max-width: 400px; margin: 0 auto;">
            <div class="card-body text-center">
                <div class="header"><b>Grants</b></div>
                <p></p>
                <div class="h1 mb-3">{{ $grantsCount }}</div>
                <div>Total Count</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card" style="width: 100%; max-width: 400px; margin: 0 auto;">
            <div class="card-body text-center">
                <div class="header"><b>Milestones</b></div>
                <p></p>
                <div class="h1 mb-3">{{ $milestonesCount }}</div>
                <div>Total Count</div>
            </div>
        </div>
    </div>
</div>


        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('overviewChart').getContext('2d');
            const overviewChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Academicians', 'Grants', 'Milestones'],
                    datasets: [{
                        data: [{{ $academiciansCount }}, {{ $grantsCount }}, {{ $milestonesCount }}],
                        backgroundColor: [
                            '#ff6384', // Pink for Academicians
                            '#36a2eb', // Blue for Grants
                            '#ba68c8'  // Purple for Milestones
                        ],
                        borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, /* Ensure the chart fits properly */
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</div>
@endsection
