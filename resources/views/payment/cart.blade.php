@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    @if (!empty(Cart::getContent()->count()))
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{ url('updatecart') }}" method="POST">
                                    @csrf

                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach (Cart::getContent() as $key => $cart)
                                                @php
                                                    $getCartProduct = App\Models\Product::getSingle($cart->id);
                                                @endphp

                                                @if (!empty($getCartProduct))
                                                    @php
                                                        $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                                                    @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="{{ url($getCartProduct->url) }}">
                                                                            <img src="{{ $getProductImage->getLogo() }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ url($getCartProduct->url) }}" style="margin-bottom: 10px; display: block;">{{ $getCartProduct->title }}</a>
                                                                        @php
                                                                            $size_id = $cart->attributes->size_id;
                                                                        @endphp

                                                                        @if (!empty($size_id))
                                                                            @php
                                                                                $getSize = App\Models\ProductSize::getProductSize($cart->attributes->size_id);
                                                                            @endphp

                                                                            <div>
                                                                                <b style="color: #c96">Size: </b>{{ $getSize->name }} ({{ number_format($getSize->price, 2) }})
                                                                            </div>
                                                                        @endif

                                                                        @php
                                                                            $color_id = $cart->attributes->color_id;
                                                                        @endphp

                                                                        @if (!empty($color_id))
                                                                            @php
                                                                                $getColor = App\Models\Color::getColor($cart->attributes->color_id);
                                                                            @endphp

                                                                            <div>
                                                                                <b style="color: #c96">Color: </b>{{ $getColor->name }}
                                                                            </div>
                                                                        @endif
                                                                    </h3>
                                                                </div>
                                                            </td>
                                                            <td class="price-col">${{ number_format($cart->price, 2) }}</td>
                                                            <td class="quantity-col">
                                                                <div class="cart-product-quantity">
                                                                    <input type="hidden" name="cart[{{$key}}][id]" value="{{ $cart->id }}">

                                                                    <input type="number" class="form-control" name="cart[{{$key}}][quantity]" value="{{ $cart->quantity }}" min="1" max="100" step="1" data-decimals="0" required>
                                                                </div>
                                                            </td>
                                                            <td class="total-col">${{ number_format($cart->price * $cart->quantity, 2) }}</td>
                                                            <td class="remove-col"><a href="{{ url('cart/delete/'.$cart->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                                                        </tr>
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="cart-bottom">
                                        {{-- <div class="cart-discount">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="coupon code">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                    </div>
                                </form>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3>

                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                            </tr>
                                            {{-- <tr class="summary-shipping">
                                                <td>Shipping:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                                    </div>
                                                </td>
                                                <td>$0.00</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                                    </div>
                                                </td>
                                                <td>$0.00</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="express-shipping">Express:</label>
                                                    </div>
                                                </td>
                                                <td>$0.00</td>
                                            </tr> --}}

                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>${{ number_format(Cart::getTotal(), 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                </div>

                                <a href="{{ url('') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            </aside>
                        </div>
                    @else
                        <p>Cart is Empty</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection