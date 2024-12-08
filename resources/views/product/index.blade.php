@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('public/page/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
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
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                @if (!empty($getSubCategory))
                    <h1 class="page-title"> {{ $getSubCategory->name }}</h1>
                @elseif(!empty($getCategory))
                    <h1 class="page-title"> {{ $getCategory->name }}</h1>
                @else
                    <h1 class="page-title"> Search: {{ Request::get('q') }} </h1>
                @endif
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                    @if (!empty($getSubCategory))
                        <li class="breadcrumb-item" ><a href="{{ url($getCategory->url) }}">{{ $getCategory->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->name }}</li>
                    @elseif(!empty($getCategory))
                        <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->name }}</li>
                    @endif
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>{{ $getProduct->perPage() }} of {{ $getProduct->total() }}</span> Products
                                </div>
                            </div>

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control changeSortBy">
                                            <option value="">Select</option>
                                            <option value="popularity">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="ProductFilters">
                            @include('product.list')
                        </div>
                        <div style="text-align: center;">
                            <a href="javascript:;" @if (empty($page)) style="display: none;" @endif data-page="{{ $page }}" class="btn btn-primary LoadMore">Load More</a>
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first">
                        <form id="FilterForm" action="" method="POST">
                            @csrf 
                            <input type="hidden" name="q" value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}">
                            <input type="hidden" name="old_subcategory_id" value="{{ !empty($getSubCategory) ? $getSubCategory->id : '' }}">
                            <input type="hidden" name="old_category_id" value="{{ !empty($getCategory) ? $getCategory->id : '' }}">
                            <input type="hidden" name="subcategory_id" id="get_subcategory_id">
                            <input type="hidden" name="brand_id" id="get_brand_id">
                            <input type="hidden" name="color_id" id="get_color_id">
                            <input type="hidden" name="sort_by_id" id="get_sort_by_id">
                            <input type="hidden" name="start_price" id="get_start_price">
                            <input type="hidden" name="end_price" id="get_end_price">
                        </form>
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div>
                            
                            @if (!empty($getSubCategoryFilter))
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                            Category
                                        </a>
                                    </h3>

                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">

                                                @foreach ($getSubCategoryFilter as $filtercategory)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input changeCategory" id="cat-{{$filtercategory->id}}" value="{{ $filtercategory->id }}">
                                                            <label class="custom-control-label" for="cat-{{ $filtercategory->id }}">{{ $filtercategory->name }}</label>
                                                        </div>
                                                        <span class="item-count">{{ $filtercategory->TotalProduct() }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">XS</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                                    <label class="custom-control-label" for="size-2">S</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked id="size-3">
                                                    <label class="custom-control-label" for="size-3">M</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked id="size-4">
                                                    <label class="custom-control-label" for="size-4">L</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-5">
                                                    <label class="custom-control-label" for="size-5">XL</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-6">
                                                    <label class="custom-control-label" for="size-6">XXL</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                        Colour
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            @foreach ($getColor as $color)
                                                <a href="javascript:;" id="{{ $color->id }}" class="changeColor" style="background: {{ $color->code }}; border: .2rem solid #e3dcdc" data-val="0"><span class="sr-only">{{ $color->name }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($getBrand as $brand)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input changeBrand" id="brand-{{ $brand->id }}" value="{{ $brand->id }}">
                                                        <label class="custom-control-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range"></span>
                                            </div>

                                            <div id="price-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ url('public/page/js/nouislider.min.js') }}"></script>

    <script type="text/javascript">
        $('.changeSortBy').change(function() {
            var id = $(this).val();
            $('#get_sort_by_id').val(id);
            FilterForm();
        });
        
        $('.changeCategory').change(function() {
            var ids = '';
            $('.changeCategory').each(function() {
                if(this.checked) {
                    var id = $(this).val();
                    ids += id+', ';
                }
            });
            $('#get_subcategory_id').val(ids);
            FilterForm();
        });
        
        $('.changeBrand').change(function() {
            var ids = '';
            $('.changeBrand').each(function() {
                if(this.checked) {
                    var id = $(this).val();
                    ids += id+', ';
                }
            });
            $('#get_brand_id').val(ids);
            FilterForm();
        });
        
        $('.changeColor').click(function() {
            var id = $(this).attr('id');
            var status = $(this).attr('data-val');
            
            if (status == 0) {
                $(this).attr('data-val', 1);
                $(this).addClass('active-color');
            } else {
                $(this).attr('data-val', 0);
                $(this).removeClass('active-color');
            }

            var ids = '';
            $('.changeColor').each(function() {
                var status = $(this).attr('data-val');
                if (status == 1) {
                    var id = $(this).attr('id');
                    ids += id+', ';
                }
            });
            $('#get_color_id').val(ids);
            FilterForm();
        });

        var xhr;

        function FilterForm() {
            if(xhr && xhr.readyState != 4) {
                xhr.abort();
            }

            var xhr = $.ajax({
                type: "POST",
                url: "{{ url('productsfilter') }}",
                data: $('#FilterForm').serialize(),
                dataType:"json",
                success: function(data) {
                    $('#ProductFilters').html(data.success);
                    $('.LoadMore').attr('data-page', data.page);

                    if(data.pag == 0) {
                        $('.LoadMore').hide();
                    } else {
                        $('.LoadMore').show();
                    }
                },
                error: function (data) {

                }
            });
        }

        $('body').delegate('.LoadMore', 'click', function () {
            var page = $(this).attr('data-page');

            $('.LoadMore').html('Loading ...');
            
            if(xhr && xhr.readyState != 4) {
                xhr.abort();
            }

            var xhr = $.ajax({
                type: "POST",
                url: "{{ url('productsfilter') }}?page="+page,
                data: $('#FilterForm').serialize(),
                dataType:"json",
                success: function(data) {
                    $('#ProductFilters').append(data.success);
                    $('.LoadMore').attr('data-page', data.page);
                    $('.LoadMore').html('Load More');

                    if(data.page == 0) {
                        $('.LoadMore').hide();
                    } else {
                        $('.LoadMore').show();
                    }
                },
                error: function (data) {

                }
            });
        });

        var i = 0;

        if ( typeof noUiSlider === 'object' ) {
            var priceSlider  = document.getElementById('price-slider');

            noUiSlider.create(priceSlider, {
                start: [ 0, 1000 ],
                connect: true,
                step: 1,
                margin: 1,
                range: {
                    'min': 0,
                    'max': 1000
                },
                tooltips: true,
                format: wNumb({
                    decimals: 0,
                    prefix: '$'
                })
            });

            // Update Price Range
            priceSlider.noUiSlider.on('update', function( values, handle ){
                var start_price = values[0];
                var end_price = values[1];
                $('#get_start_price').val(start_price);
                $('#get_end_price').val(end_price);
                $('#filter-price-range').text(values.join(' - '));
                if(i == 0 || i == 1) {
                    i++;
                } else {
                    FilterForm();
                }
            });
        }
    </script>
    <script type="text/javascript">      
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
