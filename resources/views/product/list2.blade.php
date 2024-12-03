<div class="product product-7">
    <figure class="product-media">
        
        <a href="{{ url($product->url) }}">
            @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                <img id="product-zoom" src="{{ $getProductImage->getLogo() }}" data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">
            @endif
        </a>

        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
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
                <div class="ratings-val" style="width: 20%;"></div>
            </div>
            <span class="ratings-text">( 2 Reviews )</span>
        </div>
    </div>
</div>