<div class="fb-product_wrap-3 fb-product-list_wrap-3 pt-40 pb-30 pt-sm-0 pt-xs-0">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Product List 3 Area -->
      @foreach ($categories->skip(4)->take(3) as $category)
      @if(count($category->Products) > 0)
      <div class="col-lg-4">
        <div class="fb-section_title-2">
          <h2>{{ $category->name }}</h2>
        </div>
        <div class="fb-single-product-slide_wrap bg-white mb-30">
          <div class="fb-product-list_active-3 owl-carousel">
            @foreach ($category->Products->chunk(3) as $productCollection)
            <div class="row">
              <!-- Begin Sigle Product Area -->
              @foreach ($productCollection as $product)
              <div class="single-product {{ $loop->first ? 'pt-20' : '' }} {{ $loop->last ? 'pb-20' : '' }}">
                <!-- Begin Product Image Area -->
                <div class="product-img">
                  <a href="{{ route('product.details',$product->id) }}">
                    <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}" alt="FB'S Prduct">
                    {{-- <img class="secondary-img"
                                                                src="{{ asset('/') }}assets/frontend/Images/product/3-5_2.jpg"
                    alt="FB'S Prduct"> --}}
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
                </div>
                <!-- Product Content Area End Here -->
              </div>
              @endforeach
              <!-- Sigle Product Area End Here -->
            </div>
            @endforeach

          </div>
        </div>
      </div>
      @endif
      @endforeach
      <!-- FB's Product List 3 Area End Here -->

    </div>
  </div>
</div>
