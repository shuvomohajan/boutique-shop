
@if (isset($cat_section4))
@if (count($cat_section4->Category->Products) > 0)
<div class="fb-product_wrap-3">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Single Product Slide Wrap Area -->
      <div class="col-lg-12">
        <div class="fb-section_title-2">
          <h2>{{ $cat_section4->name }}</h2>
        </div>
        <div class="fb-single-product-slide_wrap bg-white mb-30">
          <div class="fb-product_active-3 owl-carousel">
            <!-- Begin Sigle Product Area -->
            @foreach ($cat_section4->Category->Products as $product)
            <div class="single-product">
              <!-- Begin Product Image Area -->
              <div class="product-img">
                <a href="{{ route('product.details',$product->id) }}">
                  <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}" alt="FB'S Prduct">
                </a>
                @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) < $days) <span class="sticker">New</span>
                  @endif
                  @if ($product->discount != null)

                  <span class="sticker-2 text-dark">{{ $product->discount }}%</span>

                  @endif
              </div>
              <!-- Product Image Area End Here -->
              <!-- Begin Product Content Area -->
              <div class="product-content">
                <h2 class="product-name">
                  <a href="{{ route('product.details',$product->id) }}">{{ $product->name }}</a>
                </h2>
                <div class="rating-box">
                  <ul class="rating">
                    @php
                    $avgRating = round($product->Reviews()->avg('rating'));
                    @endphp
                    <li class="{{ $avgRating >= 1 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                    <li class="{{ $avgRating >= 2 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                    <li class="{{ $avgRating >= 3 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                    <li class="{{ $avgRating >= 4 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                    <li class="{{ $avgRating >= 5 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                  </ul>
                </div>
                <div class="price-box">
                  @if ($product->regular_price && $product->sell_price == null)

                  <span class="new-price">&#2547; {{ $product->regular_price }}</span>
                  @else
                  <span class="new-price">&#2547; {{ $product->sell_price }}</span>

                  <span class="old-price">{{ $product->regular_price }}</span>
                  @endif
                  @if (($product->stock - $product->stock_out) < 1) <small class="text-danger float-right">
                    Out of stock
                    </small>
                    @endif
                </div>
                <div class="product-action">
                  <ul class="product-action-link">
                    <li class="shopping-cart_link"><a href="javascript:;" class="plus-btn ppb{{$product->id}} btn add-to-cart cartPlus cart{{$product->id}}" data-id="{{ $product->id }}"
                        title="Shopping Cart"><i class="ion-bag"></i></a></li>
                    <li class="quick-view-btn"><a href="#" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                  </ul>
                </div>
              </div>
              <!-- Product Content Area End Here -->
            </div>
            @endforeach
            <!-- Sigle Product Area End Here -->
          </div>
        </div>
      </div>
      <!-- Single Product Slide Area End Here -->
    </div>
  </div>
</div>
@endif

@endif

