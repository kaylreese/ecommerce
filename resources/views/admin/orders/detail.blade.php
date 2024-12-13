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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">       
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                <i class="fas fa-globe"></i> {{ $setting->website_name }}
                                <small class="float-right">Date: {{ date('d-m-Y', strtotime($order->created_at)) }}</small>
                                </h4>
                            </div>
                        </div>
    
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>{{ $setting->website_name }}, Inc.</strong><br>
                                    Address: {{ $setting->address }}<br>
                                    Phone: {{ $setting->phone }}<br>
                                    Email: {{ $setting->email }}
                                </address>
                            </div>
                            
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $order->first_name }} {{ $order->last_name}}</strong><br>
                                    Address: {{ $order->address }}<br>
                                    Phone: {{ $order->phone }}<br>
                                    Email: {{ $order->email }}
                                </address>
                            </div>
                            
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{ $order->id }}</b><br>
                                <b>Order ID:</b> {{ $order->order_number }}<br>
                                <b>Payment Due:</b> {{ date('d-m-Y h:i A', strtotime($order->created_at)) }}<br>
                                <b>Payment Method:</b> <span style="text-transform: capitalize; font-weight: normal;">{{ $order->payment_method }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 table-responsive">
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
                                        @if (!empty($order->items))
                                            @foreach ($order->items as $item)
                                                @php
                                                    $productImage = $item->product->getImageSingle($item->product->id);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <img style="width: 60px; height: 60px;" src="{{ $productImage->getLogo() }}">
                                                    </td>
                                                    <td><a target="_blank" href="{{ url($item->product->url) }}">{{ $item->product->title }}</a></td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->size_name }}</td>
                                                    <td>{{ $item->color_name }}</td>
                                                    <td>{{ number_format($item->size_amount , 2) }}</td>
                                                    <td>{{ number_format($item->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else 
                                            <tr>
                                                <td colspan="8"> Ningún registro encontrado para mostrar.</td>
                                            </tr>    
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
        
                        <div class="row">
                            <div class="col-6">
                                <p class="lead"><b>Payment Methods:</b></p>
                                <img src="{{ url('public/assets/dist/img/credit/visa.png') }}" alt="Visa">
                                <img src="{{ url('public/assets/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                                <img src="{{ url('public/assets/dist/img/credit/american-express.png') }}" alt="American Express">
                                <img src="{{ url('public/assets/dist/img/credit/paypal2.png') }}" alt="Paypal">
            
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                plugg  dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>

                                <p class="lead"><b>Notes:</b></p>

                                <p>
                                    <span style="text-transform: capitalize; font-weight: normal;">{{ $order->notes }}</span>
                                </p>
                            </div>
                            
                            <div class="col-6">
                                <p class="lead">Amount Due  {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
            
                                <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        {{-- <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$250.30</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Discount Code {{ $order->discount_code }}</th>
                                            <td style="text-align: right;">${{ number_format($order->discount_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping {{ $order->shipping->name }}:</th>
                                            <td style="text-align: right;">${{ number_format($order->shipping_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td style="text-align: right;">${{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row no-print">
                            <div class="col-12">
                                <a type="button" href="{{ url('admin/orders') }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-return"></i> REGRESAR
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
