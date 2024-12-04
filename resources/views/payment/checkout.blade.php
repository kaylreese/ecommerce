@extends('layouts.app')

{{-- @section('style')
    <link rel="stylesheet" href="{{ url('public/page/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
    </style>
@endsection --}}

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div>
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Company Name (Optional)</label>
                                    <input type="text" class="form-control">

                                    <label>Country *</label>
                                    <input type="text" class="form-control" required>

                                    <label>Street address *</label>
                                    <input type="text" class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>State / County *</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" required>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                        <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                    </div><!-- End .custom-checkbox -->

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                        <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                                    </div>

                                    <label>Order notes (optional)</label>
                                    <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3>

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach (Cart::getContent() as $key => $cart)
                                                @php
                                                    $getCartProduct = App\Models\Product::getSingle($cart->id);
                                                @endphp
                                                <tr>
                                                    <td><a href="{{ url($getCartProduct->url) }}">{{ $getCartProduct->title }}</a></td>
                                                    <td>${{ number_format($cart->price * $cart->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="cart-discount">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="getDiscountCode" placeholder="Discount code">
                                                            <div class="input-group-append">
                                                                <button id="ApplyDiscount" style="height: 38px;" class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Discount:</td>
                                                <td><span id="getDiscountAmount">0.00</span></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping:</td>
                                                <td>Free shipping</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td><span id="getPayableTotal">${{ number_format(Cart::getTotal(), 2) }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="accordion-summary" id="accordion-payment">
                                        <div class="card">
                                            <div class="card-header" id="heading-3">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                        Cash on delivery
                                                    </a>
                                                </h2>
                                            </div>
                                            <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                                <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading-4">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                        PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                    </a>
                                                </h2>
                                            </div>
                                            <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading-5">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                        Credit Card (Stripe)
                                                        <img src="{{ url('public/page/images/payments-summary.png')}}" alt="payments cards">
                                                    </a>
                                                </h2>
                                            </div>
                                            <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                                                <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div>
                            </aside>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        $('body').delegate('#ApplyDiscount', 'click', function () {
            var discount_code = $('#getDiscountCode').val();

            $.ajax({
                type: "POST",
                url: "{{ url('checkout/apply_discount_code') }}",
                data: {
                    discount_code: discount_code,
                    "_token": "{{ csrf_token() }}",
                },
                dataType:"json",
                success: function(data) {
                    $('#getDiscountAmount').html(data.discount_amount);
                    $('#getPayableTotal').html('$'+data.payable_total);

                    if (data.status == false) {
                        alert(data.message);
                    }
                },
                error: function (data) {

                }
            });
        });
    </script>
@endsection
