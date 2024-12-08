<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Eur</a></li>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            @if (!empty(Auth::check()))
                                <li><a href="{{ url('wishlist') }}"><i class="icon-heart-o"></i>My Wishlist</a></li>
                            @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-heart-o"></i>My Wishlist</a></li>
                            @endif
                            <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                            @if (!empty(Auth::check()))
                                <li><a href="{{ url('user/dashboard') }}"><i class="icon-user"></i>{{ Auth::user()->name }}</a></li>
                            @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="index.html" class="logo">
                    <img src="{{ url('public/page/images/logo.png') }}" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            <a href="{{ url('') }}">Home</a>
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">Shop</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getCategories = App\Models\Category::getCategoriesMenu();
                                                @endphp
                                                @foreach ($getCategories as $value)
                                                    @if (!@empty($value->getSubCategory->count()))
                                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                                            <a href="{{ url($value->url) }}" class="menu-title">{{ $value->name }}</a>
                                                            <ul>
                                                                @foreach ($value->getSubCategory as $val)
                                                                    <li><a href="{{ url($value->url.'/'.$val->url) }}"> {{ $val->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{ url('search') }}" method="GET">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" placeholder="Search in..." required>
                        </div>
                    </form>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{ Cart::getContent()->count() }}</span>
                    </a>
                    @if (!empty(Cart::getContent()->count()))
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">
                                
                                @foreach (Cart::getContent() as $header_cart)
                                    @php
                                        $getCartProduct = App\Models\Product::getSingle($header_cart->id);
                                    @endphp

                                    @if (!empty($getCartProduct))
                                        @php
                                            $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                                        @endphp
                                    
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="{{ url($getCartProduct->url) }}">{{ $getCartProduct->title }}</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $header_cart->quantity }}</span>
                                                    x ${{ number_format($header_cart->price, 2) }}
                                                </span>
                                            </div>

                                            <figure class="product-image-container">
                                                <a href="{{ url($getCartProduct->url) }}" class="product-image">
                                                    <img src="{{ $getProductImage->getLogo() }}" alt="product">
                                                </a>
                                            </figure>
                                            <a href="{{ url('cart/delete/'.$header_cart->id) }}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">${{ number_format(Cart::getSubTotal(), 2) }}</span>
                            </div>

                            <div class="dropdown-cart-action">
                                <a href="{{ url('cart') }}" class="btn btn-primary">View Cart</a>
                                <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>