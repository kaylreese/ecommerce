@extends('layouts.app')

@section('style')
<style type="text/css">
    .active-color {
        border: 3px solid #000 !important;
    }
    .btn-wishlist-add::before {
        content: '\f233' !important;
    }
</style>
@endsection

@section('content')
    <main class="main">
        <div class="intro-section bg-lighter pt-5 pb-6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                            <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                    "nav": false, 
                                    "responsive": {
                                        "768": {
                                            "nav": true
                                        }
                                    }
                                }'>
                                @foreach ($sliders as $slider)
                                    @if(!empty($slider->getImage()))
                                        <div class="intro-slide">
                                            <figure class="slide-image">
                                                <picture>
                                                    <source media="(max-width: 480px)" srcset="{{ $slider->getImage() }}">
                                                    <img src="{{ $slider->getImage() }}" alt="Image Desc">
                                                </picture>
                                            </figure>

                                            <div class="intro-content">
                                                <h3 class="intro-subtitle">{{ $slider->subtitle }}</h3>
                                                <h1 class="intro-title">{!! $slider->title !!}</h1>

                                                @if(!empty($slider->button_link))
                                                    <a href="{{ $slider->button_link }}" class="btn btn-outline-white">
                                                        <span>{{ $slider->button_name }}</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <span class="slider-loader"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-6"></div>

                <div class="owl-carousel owl-simple" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": false,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            }
                        }
                    }'>

                    @foreach ($partners as $partner)
                        @if(!empty($partner->getImage()))
                            <a href="{{ !empty($partner->button_link) ? $partner->button_link : '#' }}" class="brand">
                                <img src="{{ $partner->getImage() }}" alt="Brand Name">
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="mb-6"></div>
        @if (!empty($getProductTrendy->count()))
            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title-lg">{{ $homesetting->trendy_product_title }}</h2>
                </div>

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
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

                            @foreach ($getProductTrendy as $trendy)
                                @php
                                    $getProductImage = $trendy->getImageSingle($trendy->id);
                                @endphp
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        {{-- <span class="product-label label-new">New</span> --}}
                                        {{-- <span class="product-label label-sale">30% OFF</span> --}}
                                        <a href="{{ url($trendy->url) }}">
                                            @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                                <img style="height: 280px; width: 100%; object-fit:cover" src="{{ $getProductImage->getLogo() }}" alt="{{ $trendy->title }}" class="product-image">
                                            @endif
                                        </a>
                
                                        <div class="product-action-vertical">
                                            @if (!empty(Auth::check()))
                                                <div class="details-action-wrapper">
                                                    <a href="javascript:;" class="btn-product-icon btn-wishlist btn-expandable add_to_wishlist add_to_wishlist{{ $trendy->id }} {{ !empty($trendy->checkWishlist($trendy->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist" id="{{ $trendy->id }}"><span>Add to Wishlist</span></a>
                                                </div>
                                            @else
                                                <div class="details-action-wrapper">
                                                    <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>Add to Wishlist</span></a>
                                                </div>
                                            @endif
                                        </div>
                                    </figure>
                
                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ url($trendy->category_url.'/'.$trendy->subcategory_url) }}">{{ $trendy->subcategory_name }}</a>
                                        </div>
                                        <h3 class="product-title"><a href="{{ url($trendy->url) }}">{{ $trendy->title }}</a></h3>
                                        <div class="product-price">
                                            {{ number_format($trendy->price, 2) }}
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ ($trendy->getReviewRating($trendy->id) / 5) * 100 }}%;"></div>
                                            </div>
                                            <span class="ratings-text">( {{ $trendy->getTotalReview() }} Reviews )</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        

        @if (!empty($categories->count()))
            <div class="container categories pt-6">
                <h2 class="title-lg text-center mb-4">{{ $homesetting->shop_category_title }}</h2>
                <div class="row">
                    @foreach ($categories as $category)
                        @if (!empty($category->getImage()))
                            <div class="col-sm-12 col-lg-4 banners-sm">
                            
                                <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                                    <a href="{{ url($category->url) }}">
                                        <img src="{{ $category->getImage() }}" alt="{{ $category->name }}">
                                    </a>

                                    <div class="banner-content banner-content-center">
                                        <h3 class="banner-title text-white"><a href="{{ url($category->url) }}">{{ $category->name }}</a></h3>
                                        @if (!empty($category->button_name))
                                            <a href="{{ url($category->url) }}" class="btn btn-outline-white banner-link">{{ $category->button_name }}<i class="icon-long-arrow-right"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="mb-5"></div>
        @endif
        
        <div class="container">
            <div class="heading heading-center mb-6">
                <h2 class="title">{{ $homesetting->recent_arrivals_title }}</h2>

                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link getCategoryProduct" id="top-{{ $category->url }}-link" data-val="{{ $category->id }}" data-toggle="tab" href="#top-{{ $category->url }}-tab" role="tab" aria-controls="trendy-{{ $category->url }}-tab" aria-selected="false">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                    <div class="products">
                        @php
                            $is_home = 1;
                        @endphp
                        @include('product.list')
                    </div>

                    <div class="more-container text-center">
                        <a href="{{ url('search') }}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="tab-pane p-0 fade getCategoryProduct{{ $category->id }}" id="top-{{ $category->url }}-tab" role="tabpanel" aria-labelledby="top-{{ $category->url }}-link">
                        
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <hr>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        <span class="icon-box-icon">
                            <i class="{{ $homesetting->payment_delivery_image }}"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{ $homesetting->payment_delivery }}</h3>
                            <p>{{ $homesetting->payment_delivery_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        <span class="icon-box-icon">
                            <i class="{{ $homesetting->refund_image }}"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{ $homesetting->refund_title }}</h3>
                            <p>{{ $homesetting->refund_description }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        <span class="icon-box-icon">
                            <i class="{{ $homesetting->support_image }}"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{ $homesetting->support_title }}</h3>
                            <p>{{ $homesetting->support_description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-2"></div><!-- End .mb-2 -->
        </div>

        @if (!@empty($blogs))
            <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
                <div class="container">
                    <h2 class="title-lg text-center mb-3 mb-md-4">{{ $homesetting->blog_title }}</h2>

                    <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>

                        @foreach ($blogs as $blog)
                            <article class="entry entry-display">
                                <figure class="entry-media">
                                    <a href="{{ url('blog/'.$blog->url) }}">
                                        <img src="{{ $blog->getImage() }}" style="height: 250px; width: 100%; object-fit: cover;" alt="{{ $blog->title }}">
                                    </a>
                                </figure>

                                <div class="entry-body pb-4 text-center">
                                    <div class="entry-meta">
                                        <a href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</a>, {{ $blog->commentCount() }} Comments
                                    </div>

                                    <h3 class="entry-title">
                                        <a href="{{ url('blog/'.$blog->url) }}">{{ $blog->title }}</a>
                                    </h3>

                                    <div class="entry-content">
                                        <p>{{ $blog->short_description }}</p>
                                        <a href="{{ url('blog/'.$blog->url) }}" class="read-more">Read More</a>
                                    </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="more-container text-center mb-0 mt-3">
                    <a href="{{ url('blog') }}" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
                </div>
            </div>
        @endif

        <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{ $homesetting->getSingupImage() }});">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-9 col-xl-8">
                        <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                            <div class="col">
                                <h3 class="cta-title text-white">{{ $homesetting->singup_title }}</h3>
                                <p class="cta-desc text-white">{{ $homesetting->singup_description }}</p>
                            </div>

                            <div class="col-auto">
                                @if (empty(Auth::check()))
                                    <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript"> 
        $('body').delegate('.getCategoryProduct', 'click', function(e) {
            var category_id = $(this).attr('data-val');

            $.ajax({
                type: "POST",
                url: "{{ url('recent_arrivals_product') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    category_id: category_id,
                },
                dataType:"json",
                success: function(data) {
                    $('.getCategoryProduct'+category_id).html(data.success);
                },
                error: function (data) {

                }
            });
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