@extends('admin.layout.app')

@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v3</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v3</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number"> {{ $totalorders }} </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Today Orders</span>
                            <span class="info-box-number">{{ $totalorderstoday }}</span>
                        </div>
                    </div>
                </div>
      
                <div class="clearfix hidden-md-up"></div>
      
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Total Payment</span>
                            <span class="info-box-number">${{ number_format($totalamount, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Today Amount</span>
                            <span class="info-box-number">${{ number_format($totalamounttoday, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="ion ion-ios-people-outline"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Total Customer</span>
                            <span class="info-box-number">{{ $totalcustomer }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="ion ion-person-add"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Today Customer</span>
                            <span class="info-box-number">{{ $totalcustomertoday }}</span>
                        </div>
                    </div>
                </div>
              </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                          <div class="d-flex justify-content-between">
                            <h3 class="card-title">Sales</h3>
                            <select class="form-control ChangeYear" style="width: 100px;">
                                @for ($i = 2023; $i<=date('Y'); $i++)
                                    <option {{ ($year == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                          </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">${{ number_format($totalamount, 2) }}</span>
                                    <span>Sales Over Time</span>
                                </p>
                            </div>
          
                            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="sales-chart-order" height="300" style="display: block; height: 200px; width: 820px;" width="1230" class="chartjs-render-monitor"></canvas>
                            </div>
            
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2"> <i class="fas fa-square text-primary"></i> Customer </span>
                                <span class="mr-2"> <i class="fas fa-square text-gray"></i> Order </span>
                                <span class="mr-2"> <i class="fas fa-square text-danger"></i> Amount </span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Latest Orders</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Order Number</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>PostCode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Discount Code</th>
                                        <th>Discount Amount ($)</th>
                                        <th>Shipping Amount ($)</th>
                                        <th>Total Amount ($)</th>
                                        <th>Payment Method</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($getLatestOrders as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->order_number }}</td>
                                        <td>{{ $value->first_name }} {{ $value->last_name}}</b>
                                        <td>{{ $value->country }}</td>
                                        <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                        <td>{{ $value->city }}</td>
                                        <td>{{ $value->state }}</td>
                                        <td>{{ $value->postcode }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->discount_code }}</td>
                                        <td>{{ number_format($value->discount_amount, 2) }}</td>
                                        <td>{{ number_format($value->shipping_amount, 2) }}</td>
                                        <td>{{ number_format($value->total_amount, 2) }}</td>
                                        <td style="text-transform: capitalize;">{{ $value->payment_method }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(".ChangeYear").change(function() {
        var year = $(this).val();
        window.location.href = "{{ url('admin/dashboard?year=') }}"+year;
    });

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $salesChart = $('#sales-chart-order')
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
        labels: ['Juanuary','February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
            {
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: [{{ $totalCustomerMonth }}]
            },
            {
                backgroundColor: '#ced4da',
                borderColor: '#ced4da',
                data: [ {{ $totalOrderMonth }} ]
            },
            {
                backgroundColor: 'red',
                borderColor: 'red',
                data: [ {{ $totalOrderAmountMonth }} ]
            }
        ]
        },
        options: {
        maintainAspectRatio: false,
        tooltips: {
            mode: mode,
            intersect: intersect
        },
        hover: {
            mode: mode,
            intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
            // display: false,
            gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
            },
            ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function (value) {
                if (value >= 1000) {
                    value /= 1000
                    value += 'k'
                }

                return '$' + value
                }
            }, ticksStyle)
            }],
            xAxes: [{
            display: true,
            gridLines: {
                display: false
            },
            ticks: ticksStyle
            }]
        }
        }
    })

    var $visitorsChart = $('#visitors-chart')
    // eslint-disable-next-line no-unused-vars
    var visitorsChart = new Chart($visitorsChart, {
        data: {
        labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
        datasets: [{
            type: 'line',
            data: [100, 120, 170, 167, 180, 177, 160],
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            pointBorderColor: '#007bff',
            pointBackgroundColor: '#007bff',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
        },
        {
            type: 'line',
            data: [60, 80, 70, 67, 80, 77, 100],
            backgroundColor: 'tansparent',
            borderColor: '#ced4da',
            pointBorderColor: '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill: false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
        }]
        },
        options: {
        maintainAspectRatio: false,
        tooltips: {
            mode: mode,
            intersect: intersect
        },
        hover: {
            mode: mode,
            intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
            // display: false,
            gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
            },
            ticks: $.extend({
                beginAtZero: true,
                suggestedMax: 200
            }, ticksStyle)
            }],
            xAxes: [{
            display: true,
            gridLines: {
                display: false
            },
            ticks: ticksStyle
            }]
        }
        }
    })

</script>
@endsection
