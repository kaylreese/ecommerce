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
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title"> My Wishlist </h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">My Wishlist</a></li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>{{ $getProduct->perPage() }} of {{ $getProduct->total() }}</span> Products
                                </div>
                            </div>
                        </div>

                        <div id="ProductFilters">
                            @include('product.list')
                        </div>
                        <div style="text-align: center;">
                            {{-- <a href="javascript:;" @if (empty($page)) style="display: none;" @endif data-page="{{ $page }}" class="btn btn-primary LoadMore">Load More</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="pagination justify-content-center">
                            {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        
    </script>
@endsection
