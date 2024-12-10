<div class="products">
    @php
        $is_home = 1;
    @endphp
    @include('product.list')
</div>

<div class="more-container text-center">
    <a href="{{ url($categories->url) }}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
</div>