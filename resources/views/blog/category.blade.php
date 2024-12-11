@extends('layouts.app')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ url('public/page/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">{{ $category->name }}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{ url('blog') }}">Blog</a></li>
                <li class="breadcrumb-item active"><a href="#">{{ $category->name }}</a></li>
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
                                            <a href="#">{{ $blog->commentCount() }} Comments</a>
                                        </div>

                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/'.$blog->url) }}">{{ $blog->title }}</a>
                                        </h2>

                                        <div class="entry-content" style="text-align: justify;">
                                            <p>{{ $blog->short_description }}</p>
                                            <a href="{{ url('blog/'.$blog->url) }}" class="read-more">Continue Reading</a>
                                        </div>
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
                    @include('blog._sidebar')
                </aside>
            </div>
        </div>
    </div>
</main>
@endsection
