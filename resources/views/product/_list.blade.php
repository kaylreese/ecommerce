
<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach ($getProduct as $value)
            @php
                $getProductImage = $value->getImageSingle($value->id);
            @endphp
            <div class="product product-7">
                <figure class="product-media">
                    
                    <a href="{{ url($getProduct->url) }}">
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
                        {{-- <a href="{{ url($getProduct->category_url.'/'.$getProduct->subcategory_url) }}">{{ $getProduct->subcategory_name }}</a> --}}
                    </div>
                    <h3 class="product-title"><a href="{{ url($getProduct->url) }}">{{ $getProduct->title }}</a></h3>
                    <div class="product-price">
                        {{ number_format($getProduct->price, 2) }}
                    </div>
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div>
                        </div>
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>