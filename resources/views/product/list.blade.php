<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach ($getProduct as $value)
            @php
                $getProductImage = $value->getImageSingle($value->id);
            @endphp
            <div class="col-12 @if(!empty($is_home)) col-md-3 col-lg-3 @else col-md-4 col-lg-4 @endif">
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        {{-- <span class="product-label label-new">New</span> --}}
                        <a href="{{ url($value->url) }}">
                            @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                <img style="height: 280px; width: 100%; object-fit:cover" src="{{ $getProductImage->getLogo() }}" alt="{{ $value->title }}" class="product-image">
                            @endif
                        </a>

                        <div class="product-action-vertical">
                            @if (!empty(Auth::check()))
                                <div class="details-action-wrapper">
                                    <a href="javascript:;" class="btn-product-icon btn-wishlist btn-expandable add_to_wishlist add_to_wishlist{{ $value->id }} {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist" id="{{ $value->id }}"><span>Add to Wishlist</span></a>
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
                            <a href="{{ url($value->category_url.'/'.$value->subcategory_url) }}">{{ $value->subcategory_name }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ url($value->url) }}">{{ $value->title }}</a></h3>
                        <div class="product-price">
                            {{ number_format($value->price, 2) }}
                        </div>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: {{ ($value->getReviewRating($value->id) / 5) * 100 }}%;"></div>
                            </div>
                            <span class="ratings-text">( {{ $value->getTotalReview() }} Reviews )</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- <div class="pagination justify-content-center">
    {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
</div> --}}