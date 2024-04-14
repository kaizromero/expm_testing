@extends('layouts.app')

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> --}}

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                </div>
                <div class="card-body">
                    Change Year
                    <select id="year-select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option selected value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <span  class="year-label" >2022</span> Rent</div>
                            <div id="total-rent" class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($total_rent[0]->total_price, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-house-user fa-fw fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <span  class="year-label" >2022</span> Total Earnings</div>
                            <div id="total-earnings" class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($total_earnings[0]->pay, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><span  class="year-label" >2022</span> Total Expenses
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div id="total-expenses"  class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{ number_format($total_expenses[0]->price, 2) }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Montly Expenses</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><span  class="year-label" >2022</span> Weekly Cashflow</h6>
                </div>
                <div class="card-body">
                    <table class="cashflow-table table">
                        <thead>
                            <th>Week</th>
                            <th>Earnings</th>
                            <th>Expenses</th>
                        </thead>
                        <tbody id="cashFlow">
                            @foreach($weekly_exps as $weekly_exp)
                            <tr>
                                <td>{{$weekly_exp->weeks}}</td>
                                <td>{{number_format($weekly_exp->earnings, 2)}}</td>
                                <td>{{number_format($weekly_exp->expenses, 2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

        

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Expenses Allocation</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><span  class="year-label" >2022</span> Total Expenses Allocation</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Category</th>
                            <th>Price</th>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($total_exp_rankings as $total_exp_ranking)
                            <tr>
                                <td>{{$total_exp_ranking->category_name}}</td>
                                <td>{{number_format($total_exp_ranking->price, 2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    

</div>


@endsection

@section('javascript')
<script>

    document.getElementById('year-select').addEventListener('change', function() {
        let year = this.value;
        // alert(year)

        fetch(`expmtest/totalMetrics/${year}`)
            .then(response => response.json())
            .then(data => {
                
                document.querySelectorAll('.year-label').forEach(element => {
                    element.textContent = year;
                });

                document.getElementById('total-rent').textContent = data.total_rent;
                document.getElementById('total-earnings').textContent = data.total_earnings;
                document.getElementById('total-expenses').textContent = data.total_expenses;

                // console.log(data.annual_earnings_values)
                // console.log(data.annual_earnings_labels)
                var ctx = document.getElementById("myAreaChart");
                let chardata =  JSON.parse(data.annual_earnings_values) ;
                let label = JSON.parse(data.annual_earnings_labels);

                let pie_data = JSON.parse(data.annual_exp_allocation_data);
                let pie_label = data.annual_exp_allocation_labels;

                let bar_chart_data = JSON.parse(data.bar_chart_array);
                
                let exp_rankings = data.total_exp_rankings;

                let weekly_exps = data.weekly_exps;

                console.log(weekly_exps)
                
                // console.log(exp_rankings)
                // console.log(data.total_exp_rankings)
                // console.log(data.total_exp_rankings.category_name)
                // console.log(bar_chart_data.annual_rent_exp_value);
                // console.log(bar_chart_data.annual_transportation_exp_value);
                // console.log(bar_chart_data);
                // console.log(data.bar_chart_array[1]);
                // console.log(data.bar_chart_array.annual_earnings_values);

                // console.log(pie_data)
                // console.log(pie_label)


                myLineChart.data.labels = label;
                myLineChart.data.datasets[0].data = chardata;
                myLineChart.update();
                
                
                myPieChart.data.labels = pie_label;
                myPieChart.data.datasets[0].data = pie_data;
                myPieChart.update();

                myBarChart.data.datasets[0].data = bar_chart_data.annual_rent_exp_value;
                myBarChart.data.datasets[1].data = bar_chart_data.annual_transportation_exp_value;
                myBarChart.data.datasets[2].data = bar_chart_data.annual_food_exp_value;
                myBarChart.data.datasets[3].data = bar_chart_data.annual_grocery_exp_value;
                myBarChart.data.datasets[4].data = bar_chart_data.annual_entertainment_exp_value;
                myBarChart.data.datasets[5].data = bar_chart_data.annual_tuition_exp_value;
                myBarChart.data.datasets[6].data = bar_chart_data.annual_medicine_exp_value;
                myBarChart.data.datasets[7].data = bar_chart_data.annual_communication_exp_value;
                myBarChart.data.datasets[8].data = bar_chart_data.annual_clothes_exp_value;
                myBarChart.data.datasets[9].data = bar_chart_data.annual_gadgets_exp_value;
                myBarChart.data.datasets[10].data = bar_chart_data.annual_transfer_exp_value;
                myBarChart.data.datasets[11].data = bar_chart_data.annual_training_exp_value;
                myBarChart.data.datasets[12].data = bar_chart_data.annual_personal_care_exp_value;
                myBarChart.data.datasets[13].data = bar_chart_data.annual_others_exp_value;
                myBarChart.data.datasets[14].data = bar_chart_data.annual_school_fee_exp_value;
                myBarChart.update();


                const options = { style: 'currency', currency: 'USD' };
                const numberFormat = new Intl.NumberFormat('en-US', options);

                // Clear existing rows
                tableBody.innerHTML = '';
                // Add new rows based on the fetched data
                exp_rankings.forEach(expense => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${expense.category_name}</td>
                        <td>${numberFormat.format(expense.price)}</td>
                    `;
                    tableBody.appendChild(row);
                });

                // Clear existing rows
                cashFlow.innerHTML = '';
                // Add new rows based on the fetched data
                weekly_exps.forEach(weekly_exp => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${weekly_exp.weeks}</td>
                        <td>${numberFormat.format(weekly_exp.earnings)}</td>
                        <td>${numberFormat.format(weekly_exp.expenses)}</td>
                    `;
                    cashFlow.appendChild(row);
                });
            });
    });



        // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var data = {{ $annual_earnings_values }};
    let label = {{ $annual_earnings_labels }};

    // console.log(label, data)
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: label,
        datasets: [{
        label: "Earnings",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        //   data: [111110, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
        data: data,
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return '$' + number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: true
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            }
        }
        }
    }
    });


</script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
    }

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    //rent
    
    let bar_chart_array = {!! $bar_chart_array !!};
    // console.log(bar_chart_array)
    var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // labels: label_rent, 
        labels: bar_chart_array.labels, 
        datasets: [
        {
        label: 'Rent',
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#4e73df",
        borderColor: "#4e73df",
        data:bar_chart_array.annual_rent_exp_value , 
        },
        {
        label: 'Transportation',
        backgroundColor: "#82E0AA",
        hoverBackgroundColor: "#82E0AA",
        borderColor: "#82E0AA",
        data:bar_chart_array.annual_transportation_exp_value , 
        },
        {
        label: 'Food',
        backgroundColor: "#F9E79F",
        hoverBackgroundColor: "#F9E79F",
        borderColor: "#F9E79F",
        data:bar_chart_array.annual_food_exp_value , 
        },
        {
        label: 'Grocery',
        backgroundColor: "#F5CBA7",
        hoverBackgroundColor: "#F5CBA7",
        borderColor: "#F5CBA7",
        data:bar_chart_array.annual_grocery_exp_value , 
        },
        {
        label: 'Entertainment',
        backgroundColor: "#8E44AD",
        hoverBackgroundColor: "#8E44AD",
        borderColor: "#8E44AD",
        data:bar_chart_array.annual_entertainment_exp_value , 
        },
        {
        label: 'Tuition',
        backgroundColor: "#A3E4D7",
        hoverBackgroundColor: "#A3E4D7",
        borderColor: "#A3E4D7",
        data:bar_chart_array.annual_tuition_exp_value , 
        },
        {
        label: 'Medicine',
        backgroundColor: "#d43759",
        hoverBackgroundColor: "#d43759",
        borderColor: "#d43759",
        data:bar_chart_array.annual_medicine_exp_value , 
        },
        {
        label: 'Communication',
        backgroundColor: "#2980B9",
        hoverBackgroundColor: "#2980B9",
        borderColor: "#2980B9",
        data:bar_chart_array.annual_communication_exp_value , 
        },
        {
        label: 'Clothes',
        backgroundColor: "#9FE2BF",
        hoverBackgroundColor: "#9FE2BF",
        borderColor: "#9FE2BF",
        data:bar_chart_array.annual_clothes_exp_value , 
        },
        {
        label: 'Gadgets',
        backgroundColor: "#CD5C5C",
        hoverBackgroundColor: "#CD5C5C",
        borderColor: "#CD5C5C",
        data:bar_chart_array.annual_gadgets_exp_value , 
        },
        {
        label: 'Money Transfer',
        backgroundColor: "#ff3385",
        hoverBackgroundColor: "#ff3385",
        borderColor: "#ff3385",
        data: bar_chart_array.annual_transfer_exp_value, 
        },
        {
        label: 'Training',
        backgroundColor: "#808000",
        hoverBackgroundColor: "#808000",
        borderColor: "#808000",
        data: bar_chart_array.annual_training_exp_value, 
        },
        {
        label: 'Personal Care',
        backgroundColor: "#00FFFF",
        hoverBackgroundColor: "#00FFFF",
        borderColor: "#00FFFF",
        data: bar_chart_array.annual_personal_care_exp_value, 
        },
        {
        label: 'Others',
        backgroundColor: "#2F4F4F",
        hoverBackgroundColor: "#2F4F4F",
        borderColor: "#2F4F4F",
        data: bar_chart_array.annual_others_exp_value, 
        },
        {
        label: 'School Fee',
        backgroundColor: "#228B22",
        hoverBackgroundColor: "#228B22",
        borderColor: "#228B22",
        data: bar_chart_array.annual_school_fee_exp_value, 
        }],
    },
    options: {
        interaction: {
            mode:'index'
        },
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'month'
            },
            gridLines: {
            display: true,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 20
            },
            maxBarThickness: 25,
        }],
        yAxes: [{
            ticks: {
            min: 0,
            max: 2000,
            maxTicksLimit: 30,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return '$' + number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            }
        }
        },
    }
    });

</script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
// console.log({{ $annual_exp_allocation_data }})
// console.log({{ $annual_exp_allocation_labels }})
var labels = {!!  $annual_exp_allocation_labels   !!};
var data = {{  $annual_exp_allocation_data  }};

// console.log(labels)
// console.log(data)
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: labels,
    datasets: [{
      data: data,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#92a8d1', '#034f84', '#f7cac9', '#f7786b', '#ffef96', '#50394c', '#4040a1', '#bc5a45', '#f18973', '#82b74b'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      enable: true, 
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});

</script>
@endsection


