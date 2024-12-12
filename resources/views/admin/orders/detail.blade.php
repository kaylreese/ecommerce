@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $header_title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Transaction ID: <span style="font-weight: normal;">{{ !empty($order->transaction_id) ? $order->transaction_id : '' }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Order Number: <span style="font-weight: normal;">{{ $order->order_number }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Name: <span style="font-weight: normal;">{{ $order->first_name }} {{ $order->last_name}}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Company Name: <span style="font-weight: normal;">{{ $order->company_name }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Country: <span style="font-weight: normal;">{{ $order->country }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Address: <span style="font-weight: normal;">{{ $order->address_one }} | {{ $order->address_two }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>City: <span style="font-weight: normal;">{{ $order->city }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>State: <span style="font-weight: normal;">{{ $order->state }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>PostCode: <span style="font-weight: normal;">{{ $order->postcode }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Phone: <span style="font-weight: normal;">{{ $order->phone }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Email: <span style="font-weight: normal;">{{ $order->email }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Discount Code: <span style="font-weight: normal;">{{ $order->discount_code }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Discount Amount ($): <span style="font-weight: normal;">{{ number_format($order->discount_amount, 2) }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Shipping Name: <span style="font-weight: normal;">{{ $order->shipping->name }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Shipping Amount ($): <span style="font-weight: normal;">{{ number_format($order->shipping_amount, 2) }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Total Amount ($): <span style="font-weight: normal;">{{ number_format($order->total_amount, 2) }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Payment Method: <span style="text-transform: capitalize; font-weight: normal;">{{ $order->payment_method }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Notes: <span style="text-transform: capitalize; font-weight: normal;">{{ $order->notes }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Status: <span style="font-weight: normal;">{{ ($order->status == 1) ? 'Active' : 'Eliminado' }}</span></label>
                        </div>
                        <div class="form-group">
                            <label>Created Date: <span style="font-weight: normal;">{{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</span></label>
                        </div>                        
                    </div>

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>QTY</th>
                                    <th>Size Name</th>
                                    <th>Color Name</th>
                                    <th>Size Amount</th>
                                    <th>Total Amount ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    @php
                                        $productImage = $item->product->getImageSingle($item->product->id);
                                    @endphp
                                    <tr>
                                        <td>
                                            <img style="width: 100px; height: 100px;" src="{{ $productImage->getLogo() }}">
                                        </td>
                                        <td><a target="_blank" href="{{ url($item->product->url) }}">{{ $item->product->title }}</a></td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->color_name }}</td>
                                        <td>{{ $item->size_name }}</td>
                                        <td>{{ number_format($item->size_amount , 2) }}</td>
                                        <td>{{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <center>
                    <a type="button" href="{{ url('admin/orders') }}"  class="btn btn-danger">Cancel</a>
                </center>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <center>
                    <a type="button" href="{{ url('admin/orders') }}"  class="btn btn-danger">Cancel</a>
                </center>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Detail</h3>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Size Name</th>
                            <th>Color Name</th>
                            <th>Size Amount</th>
                            <th>Total Amount ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            @php
                                $productImage = $item->product->getImageSingle($item->product->id);
                            @endphp
                            <tr>
                                <td>
                                    <img style="width: 100px; height: 100px;" src="{{ $productImage->getLogo() }}">
                                </td>
                                <td><a target="_blank" href="{{ url($item->product->url) }}">{{ $item->product->title }}</a></td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->color_name }}</td>
                                <td>{{ $item->size_name }}</td>
                                <td>{{ number_format($item->size_amount , 2) }}</td>
                                <td>{{ number_format($item->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="padding: 10px; float: right;">
                    {{-- {!! $order->items->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
