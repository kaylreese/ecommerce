
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
            @foreach ($getPopular as $popular)
                <li>
                    <figure>
                        <a href="{{ url('blog/'.$popular->url) }}">
                            <img src="{{ $popular->getImage() }}" alt="{{ $popular->title }}">
                        </a>
                    </figure>

                    <div>
                        <span>{{ \Carbon\Carbon::parse($popular->created_at)->format('M d, Y') }}</span>
                        <h4><a href="{{ url('blog/'.$popular->url) }}">{{ $popular->title }}</a></h4>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
