@extends('layouts.app')

@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">{{ $header_title }}</h1>
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
                            @include('layouts._message')

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Transaction ID: <span style="font-weight: normal;">{{ $order->order_number }}</span></label>
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
                                    <label>Status: 
                                        <span style="font-weight: normal;">
                                            @if ($order->status == 0)
                                                Pending
                                            @elseif ($order->status == 1)
                                                In Progress
                                            @elseif ($order->status == 2)
                                                Delivered
                                            @elseif ($order->status == 3)
                                                Completed
                                            @elseif ($order->status == 4)
                                                Cancelled
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Created Date: <span style="font-weight: normal;">{{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</span></label>
                                </div>  
                            </div>

                            <div class="card">
                                <div class="card-header" style="margin-top: 20px;">
                                    <h3 class="card-title">Product Detail</h3>
                                </div>
                    
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Size Amount ($)</th>
                                                <th>Total Amount ($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                @php
                                                    $productImage = $item->product->getImageSingle($item->product->id);
                                                @endphp
                                                <tr>
                                                    <td style="min-width: 100px;">
                                                        <img style="width: 100px; height: 100px; padding-left: 10px;" src="{{ $productImage->getLogo() }}">
                                                    </td>
                                                    <td style="min-width: 300px; max-with: 300px;">
                                                        <a target="_blank" href="{{ url($item->product->url) }}">{{ $item->product->title }}</a>
                                                        <br>
                                                        @if(!empty($item->color_name)) 
                                                            <b style="color: gray;">Color Name:</b> {{ $item->color_name }} <br>
                                                        @endif 
                                                        @if(!empty($item->size_name)) 
                                                            <b style="color: gray;">Size Name:</b> {{ $item->size_name }} <br>
                                                        @endif 
                                                        
                                                        @if ($order->status == 3)
                                                            @php
                                                                $getReview = $item->getReview($item->product->id, $order->id);
                                                            @endphp
                                                            <br>
                                                            @if (!empty($getReview))
                                                                {{-- <b style="color: gray;">How many rating:</b> {{ $getReview->rating }} --}}
                                                                <div class="ratings-container" style="margin-bottom: 0;">
                                                                    <div class="ratings">
                                                                        <div class="ratings-val" style="width: {{ ($getReview->rating / 5) * 100 }}%;"></div>
                                                                    </div>
                                                                </div>
                                                                <b style="color: gray;">Review:</b> {{ $getReview->review }}
                                                            @else
                                                                <button class="btn btn-primary MakeReview" id="{{ $item->product->id }}" data-order="{{ $order->id }}">Make Review</button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center;">{{ $item->quantity }}</td>
                                                    <td style="text-align: right;">{{ number_format($item->price, 2) }}</td>
                                                    <td style="text-align: right;">{{ number_format($item->size_amount , 2) }}</td>
                                                    <td style="text-align: right; padding-right: 10px;">{{ number_format($item->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                    
                                    {{-- <div style="padding: 10px; float: right;">
                                        {!! $order->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Make Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('user/make-review') }}" method="post">
                @csrf

                <input type="hidden" name="product_id" id="getProductId" required>
                <input type="hidden" name="order_id" id="getOrderId" required>
                <div class="modal-body" style="padding: 20px;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="">How many rating?</label>
                        <select class="form-control" name="rating" id="" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Review</label>
                        <textarea class="form-control" name="review" id="" cols="30" rows="10" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('body').delegate('.MakeReview', 'click', function() {
        var product_id = $(this).attr('id');
        var order_id = $(this).attr('data-order');
        $('#getProductId').val(product_id);
        $('#getOrderId').val(order_id);
        $('#MakeReviewModal').modal('show');
    });
</script>
@endsection
