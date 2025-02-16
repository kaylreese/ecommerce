@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('public/page/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
        .btn-product.btn-cart {
            background: #fff;
            color: #c96;
            border: 1px solid #c96; /* Opcional: agrega un borde */
            transition: background 0.3s, color 0.3s; /* Animación suave */
        }
    
        .btn-product.btn-cart:hover {
            background: #c96; /* Invertimos el fondo */
            color: #fff;     /* Invertimos el texto */
        }

        .btn-wishlist-add::before {
            content: '\f233' !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ $getProduct->getCategory->url }}">{{ $getProduct->getCategory->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ $getProduct->getCategory->url.'/'.$getProduct->getSubCategory->url }}">{{ $getProduct->getSubCategory->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
                </ol>

                {{-- <nav class="product-pager ml-auto" aria-label="Product">
                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                        <i class="icon-angle-left"></i>
                        <span>Prev</span>
                    </a>

                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                        <span>Next</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </nav> --}}
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                @include('layouts._message')
                
                <div class="product-details-top mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    @php
                                        $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                    @endphp

                                    @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo() }}" data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    @endif
                                </figure>

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($getProduct->getImages as $image)
                                        <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}" data-zoom-image="{{ $image->getLogo() }}">
                                            <img src="{{ $image->getLogo() }}" alt="product side">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $getProduct->title }}</h1>

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ ($getProduct->getReviewRating($getProduct->id) / 5) * 100 }}%;"></div>
                                    </div>

                                    <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $getProduct->getTotalReview() }} Reviews )</a>
                                </div>

                                <div class="product-price">
                                    $<span id="getTotalPrice">{{ number_format($getProduct->price, 2) }}</span>
                                </div>

                                <div class="product-content">
                                    <p> {{ $getProduct->short_description }} </p>
                                </div>

                                {{-- <div class="details-filter-row details-row-size">
                                    <label>Color:</label>

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #eab656;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #3a588b;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #caab97;"><span class="sr-only">Color name</span></a>
                                    </div>
                                </div> --}}

                                <form action="{{ url('product/add-to-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $getProduct->id }}">

                                    @if (!empty($getProduct->getColor->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="color">Color:</label>
                                            <div class="select-custom">
                                                <select name="color_id" id="color_id" class="form-control" required>
                                                    <option value="">Select a Color</option>
                                                    @foreach ($getProduct->getColor as $color)
                                                        <option value="{{ $color->getColor->id }}">{{ $color->getColor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($getProduct->getSize->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Size:</label>
                                            <div class="select-custom">
                                                <select name="size_id" id="size_id" class="form-control getSizePrice" required>
                                                    <option data-price="0" value="">Select a Size</option>
                                                    @foreach ($getProduct->getSize as $size)
                                                        <option data-price="{{ !empty($size->price) ? number_format($size->price, 2) : 0 }}" value="{{ $size->id }}">{{ $size->name }} @if (!empty($size->price)) (${{ number_format($size->price, 2) }}) @endif</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" max="100" step="1" data-decimals="0" required>
                                        </div>
                                    </div>

                                    <div class="product-details-action">
                                        <button type="submit" class="btn-product btn-cart">add to cart</button>

                                        @if (Auth::check())
                                            <div class="details-action-wrapper">
                                                <a href="javascript:;" class="btn-product btn-wishlist add_to_wishlist add_to_wishlist{{ $getProduct->id }} {{ !empty($getProduct->checkWishlist($getProduct->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist" id="{{ $getProduct->id }}"><span>Add to Wishlist</span></a>
                                            </div>
                                        @else
                                            <div class="details-action-wrapper">
                                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </form>

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="{{ $getProduct->getCategory->url }}">{{ $getProduct->getCategory->name }}</a>
                                        <a href="{{ $getProduct->getCategory->url.'/'.$getProduct->getSubCategory->url }}">{{ $getProduct->getSubCategory->name }}</a>>
                                    </div>

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-details-tab product-details-extended">
                <div class="container">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $getProduct->getTotalReview() }})</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content" style="margin-top: 20px;">
                            <div class="container">
                                {!! $getProduct->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content" style="margin-top: 20px;">
                            <div class="container">
                                {!! $getProduct->addition_information !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content" style="margin-top: 20px;">
                            <div class="container">
                                {!! $getProduct->shipping_returns !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <div class="container">
                                <h3>Reviews ({{ $getProduct->getTotalReview() }})</h3>

                                @foreach ($getReview as $review)
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">{{ $review->name }} {{ $review->last_name }}</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: {{ ($review->rating / 5) * 100 }}%;"></div>
                                                    </div>
                                                </div>
                                                <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <div class="col">
                                                <h4>Good, perfect size</h4>

                                                <div class="review-content">
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div style="padding: 10px; float: right;">
                                    {!! $getReview->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2 class="title text-center mb-4">You May Also Like</h2>
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>

                    @foreach ($getRelatedProduct as $product)
                        @php
                            $getProductImage = $product->getImageSingle($product->id);
                        @endphp

                        <div class="product product-7">
                            <figure class="product-media">
                                
                                <a href="{{ url($product->url) }}">
                                    @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo() }}" data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">
                                    @endif
                                </a>
                                
                                <div class="product-action-vertical">
                                    @if (Auth::check())
                                        <div class="details-action-wrapper">
                                            <a href="javascript:;" class="btn-product-icon btn-wishlist btn-expandable add_to_wishlist add_to_wishlist{{ $getProduct->id }} {{ !empty($product->checkWishlist($product->id)) ? 'btn-wishlist-add' : '' }}" id="{{ $product->id }}"><span>Add to Wishlist</span></a>
                                        </div>
                                    @else
                                        <div class="details-action-wrapper">
                                            <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></a>
                                        </div>
                                    @endif
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="{{ url($product->category_url.'/'.$product->subcategory_url) }}">{{ $product->subcategory_name }}</a>
                                </div>
                                <h3 class="product-title"><a href="{{ url($product->url) }}">{{ $product->title }}</a></h3>
                                <div class="product-price">
                                    {{ number_format($product->price, 2) }}
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ ($getProduct->getReviewRating($product->id) / 5) * 100 }}%;"></div>
                                    </div>
                                    <span class="ratings-text">( {{ $product->getTotalReview() }} Reviews )</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ url('public/page/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('public/page/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ url('public/page/js/bootstrap-input-spinner.js') }}"></script>

    <script type="text/javascript">
        $('.getSizePrice').change(function() {
            var productprice = '{{ $getProduct->price }}';
            var price = $('option:selected', this).attr('data-price');
            var total = parseFloat(productprice) + parseFloat(price);
            $('#getTotalPrice').html(total.toFixed(2));
            console.log(total.toFixed(2))
        });

        
        $('body').delegate('.add_to_wishlist', 'click', function(e) {
            var product_id = $(this).attr('id');
            console.log(product_id);

            $.ajax({
                type: "POST",
                url: "{{ url('user/add_to_wishlist') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,
                },
                dataType:"json",
                success: function(data) {
                    if (data.is_wishlist == 1) {
                        toastr.success('Agregado a tus favoritos');
                        $('.add_to_wishlist'+product_id).addClass('btn-wishlist-add');
                    } else {
                        $('.add_to_wishlist'+product_id).removeClass('btn-wishlist-add');
                        toastr.success('Quitado de tus favoritos');
                    }
                },
                error: function (data) {

                }
            });
        });
    </script>
@endsection
