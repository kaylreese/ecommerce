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
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{ $blog->title }}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('blog') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </div>
        @include('layouts._message')
    </nav>
    
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{ $blog->getImage() }}" alt="{{ $blog->title }}">
                        </figure>

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }} </a>
                                <span class="meta-separator">|</span>
                                <a href="#">{{ $blog->commentCount() }} Comments</a>
                                @if (!empty($blog->category))
                                    <span class="meta-separator">|</span>
                                    <a href="{{ url('blog/category/'.$blog->category->url) }}">#{{ $blog->category->name }}</a>
                                @endif
                            </div>
                            <br />

                            <div class="entry-content editor-content" style="text-align: justify;">
                                {{-- <blockquote>
                                    <p>{{ $blog->short_description }}</p>
                                </blockquote> --}}
                                <p> {{ $blog->short_description }} </p> <br/>

                                {!! $blog->description !!}
                            </div>

                            {{-- <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    <div class="entry-tags">
                                        <span>Tags:</span> <a href="#">photography</a> <a href="#">style</a>
                                    </div>
                                </div>

                                <div class="col-md-auto mt-2 mt-md-0">
                                    <div class="social-icons social-icons-color">
                                        <span class="social-label">Share this post:</span>
                                        <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </article>

                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3>

                        <div class="owl-carousel owl-simple" data-toggle="owl" 
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
                                    }
                                }
                            }'>


                            @foreach ($getRelatedPost as $related)
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="{{ $related->getImage() }}" alt="{{ $related->title }}">
                                        </a>
                                    </figure>

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">{{ \Carbon\Carbon::parse($related->created_at)->format('M d, Y') }}</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">{{ $related->commentCount() }} Comments</a>
                                        </div>

                                        <h2 class="entry-title">
                                            <a href="{{ url('blog/'.$related->url) }}">{{ $related->title }}</a>
                                        </h2>
                                        @if (!empty($related->category))
                                            <div class="entry-cats">
                                                in <a href="{{ url('blog/category/'.$related->category->url) }}">{{ $related->category->name }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="comments">
                        <h3 class="title">{{ $blog->commentCount() }} Comments</h3>

                        <ul>
                            @foreach ($blog->comments as $comment)
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div class="comment-user">
                                                <h4><a href="#">{{ $comment->user->name }}</a></h4>
                                                <span class="comment-date">{{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($comment->created_at)->format('h:i A') }}</span>
                                            </div>

                                            <div class="comment-content">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="reply">
                        <div class="heading">
                            <h3 class="title">Leave A Reply</h3>
                            <p class="title-desc">Your email address will not be published. Required field is marked *</p>
                        </div>

                        <form action="{{ url('blog/submit_comment') }}" method="POST">
                            @csrf
                            
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                            <label for="reply-message" class="sr-only">Comment</label>
                            <textarea name="comment" id="comment" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>

                            @if (!empty(Auth::check()))
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>POST COMMENT</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            @else
                                <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2">
                                    <span>POST COMMENT</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <aside class="col-lg-3">
                    @include('blog._sidebar')
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
