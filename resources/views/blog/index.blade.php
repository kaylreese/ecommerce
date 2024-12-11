@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('public/page/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ $page->getImage() }})">
        <div class="container">
            <h1 class="page-title">{{ $page->title }}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('blog') }}">Blog</a></li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="entry-container max-col-2" data-layout="fitRows">
                        @foreach ($blogs as $blog)
                            <div class="entry-item col-sm-6">
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="{{ url('blog/'.$blog->url) }}">
                                            <img src="{{ $blog->getImage() }}" style="height: 300px; width: 100%; object-fit: cover;" alt="image desc">
                                        </a>
                                    </figure>

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }} </a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">0 Comments</a>
                                        </div>

                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/'.$blog->url) }}">{{ $blog->title }}</a>
                                        </h2>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <nav aria-label="Page navigation">
                        {!! $blogs->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </nav>
                </div>

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3>

                            <form action="{{ url('blog') }}" method="GET">
                                <label for="ws" class="sr-only">Search in blog</label>
                                <input type="search" class="form-control" name="search" id="search" value="{{ Request::get('search') }}" placeholder="Search in blog" required>
                                <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">Search</span></button>
                            </form>
                        </div>

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Categories</h3>

                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="{{ url('blog/category/'.$category->url) }}">{{ $category->name }}<span>{{ $category->getCountBlog() }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Popular Posts</h3>

                            <ul class="posts-list">
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="public/page/images/blog/sidebar/post-1.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 22, 2018</span>
                                        <h4><a href="#">Aliquam tincidunt mauris eurisus.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="public/page/images/blog/sidebar/post-2.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 19, 2018</span>
                                        <h4><a href="#">Cras ornare tristique elit.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="public/page/images/blog/sidebar/post-3.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 12, 2018</span>
                                        <h4><a href="#">Vivamus vestibulum ntulla nec ante.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="public/page/images/blog/sidebar/post-4.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 25, 2018</span>
                                        <h4><a href="#">Donec quis dui at dolor  tempor interdum.</a></h4>
                                    </div>
                                </li>
                            </ul>
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

    </script>
@endsection
