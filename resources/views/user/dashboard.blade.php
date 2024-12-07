@extends('layouts.app')

@section('style')
    <style>
        .box-btn {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }
    </style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br>
                <div class="row">
                    @include('user._sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalorders }}</div>
                                        <div style="font-size: 16px;">Total Order</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalorderstoday }}</div>
                                        <div style="font-size: 16px;">Today Order</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ number_format($totalamount, 2) }}</div>
                                        <div style="font-size: 16px;">Total Amount</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ number_format($totalamounttoday , 2) }}</div>
                                        <div style="font-size: 16px;">Today Amount</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalPending }}</div>
                                        <div style="font-size: 16px;">Pending Order</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalInprogress }}</div>
                                        <div style="font-size: 16px;">In Progree Order</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalCompleted }}</div>
                                        <div style="font-size: 16px;">Completed Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $totalCancelled }}</div>
                                        <div style="font-size: 16px;">Cancelled Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection