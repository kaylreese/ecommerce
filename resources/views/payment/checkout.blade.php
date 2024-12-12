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
        {{-- <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')"> --}}
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="" id="FormUser" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" name="first_name" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Company Name (Optional)</label>
                                    <input type="text" name="company_name" class="form-control">

                                    <label>Country *</label>
                                    <input type="text" name="country" class="form-control" required>

                                    <label>Street address *</label>
                                    <input type="text" name="address_one" class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" name="address_two" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" name="city" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>State / County *</label>
                                            <input type="text" name="state" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" name="postcode" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" name="phone" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Email address *</label>
                                    <input type="email" name="email" class="form-control" required>

                                    @if (empty(Auth::check()))
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_create" class="custom-control-input createAccount" id="checkout-create-acc">
                                            <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                        </div>

                                        <div id="showPassword" style="display: none;">
                                            <label>Password </label>
                                            <input type="password" name="password" id="inputPassword" class="form-control">
                                        </div>
                                    @endif

                                    <label>Order notes (optional)</label>
                                    <textarea class="form-control" cols="30" name="notes" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
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
                                                            <input type="text" class="form-control" name="discount_code" id="getDiscountCode" placeholder="Discount code">
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
                                            <tr class="summary-chipping">
                                                <td>Shipping:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            @foreach ($getShipping as $shipping)
                                                <tr class="summary-shipping-row">
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="free-shipping-{{ $shipping->id }}" value="{{ $shipping->id }}" name="shipping" data-price="{{ !empty($shipping->price) ? $shipping->price : 0 }}" class="custom-control-input getShippingCharge" required>
                                                            <label class="custom-control-label" for="free-shipping-{{ $shipping->id }}">{{ $shipping->name }}</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if (!empty($shipping->price))
                                                            ${{ number_format($shipping->price, 2) }}
                                                        @endif 
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>$<span id="getPayableTotal">{{ number_format(Cart::getSubTotal(), 2) }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" id="getShippingChargeTotal" value="0">
                                    <input type="hidden" id="PayableTotal" value="{{ Cart::getSubTotal() }}">

                                    <div class="accordion-summary" id="accordion-payment">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="Cash" name="payment_method" value="cash" class="custom-control-input" required>
                                            <label class="custom-control-label" for="Cash">Cash on delivery</label>
                                        </div>
                                        {{-- <div class="custom-control custom-radio" style="margin-top: 0px;">
                                            <input type="radio" id="PayPal" name="payment_method" value="paypal" class="custom-control-input" required>
                                            <label class="custom-control-label" for="PayPal">PayPal What is PayPal?</label>
                                        </div> --}}
                                        <div class="custom-control custom-radio" style="margin-top: 0px;">
                                            <input type="radio" id="CreditCard" name="payment_method" value="stripe" class="custom-control-input" required>
                                            <label class="custom-control-label" for="CreditCard">Credit Card (Stripe)</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                    <br/><br/>
                                    <img src="{{ url('public/page/images/payments-summary.png')}}">
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
    
        $('body').delegate('.createAccount', 'change', function () {
            if(this.checked) {
                $('#showPassword').show();
                $('#inputPassword').prop('required', true);
            } else {
                $('#showPassword').hide();
                $('#inputPassword').prop('required', false);
            }
        });

        $('body').delegate('#FormUser', 'submit',function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('checkout/place_order') }}",
                data: new FormData(this),
                processData:false,
                contentType: false,
                dataType:"json",
                success: function(data) {
                    if(data.status == false) {
                        alert(data.message);
                    } else {
                        window.location.href = data.redirect;
                    }
                },
                error: function (data) {

                }
            });
        });

        $('body').delegate('.getShippingCharge', 'change', function () {
            var price = $(this).attr('data-price');
            var total = $('#PayableTotal').val();
            $('#getShippingChargeTotal').val(price);
            var final_total = parseFloat(price) + parseFloat(total);
            $('#getPayableTotal').html(final_total.toFixed(2));
        });

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
                    var shipping = $('#getShippingChargeTotal').val();
                    var final_total = parseFloat(shipping) + parseFloat(data.payable_total);

                    $('#getPayableTotal').html(final_total.toFixed(2));
                    $('#PayableTotal').val(data.payable_total);

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
