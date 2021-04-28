

<div class="fb-product_wrap-3 fb-product-list_wrap-3 pt-40 pb-30 pt-sm-0 pt-xs-0">
  <div class="container">
    <div class="row">
      @if (isset($cat_section5))
      <div class="col-lg-4">
        <div class="fb-section_title-2">
          <h2>{{ $cat_section5->name }}</h2>
        </div>
        <div class="fb-single-product-slide_wrap bg-white mb-30">
          <div class="fb-product-list_active-3 owl-carousel">

              @if (count($cat_section5->Category->Products) > 0)
                @foreach ($cat_section5->Category->Products->take(12)->chunk(3) as $productCollection)
                <div class="row">
                  @foreach ($productCollection as $product)
                  <!-- Begin Sigle Product Area -->
                  <div class="single-product {{ $loop->first ? 'pt-20' : '' }} {{ $loop->last ? 'pb-20' : '' }}">
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

                        <span class="new-price">&#2547;{{ $product->regular_price }}</span>
                        @else
                        <span class="new-price">&#2547;{{ $product->sell_price }}</span>

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
                </div>
                @endforeach
            @endif

          </div>
        </div>
      </div>
      @endif


      @if (isset($cat_section6))
      <div class="col-lg-4">
        <div class="fb-section_title-2">
          <h2>{{ $cat_section6->name }}</h2>
        </div>
        <div class="fb-single-product-slide_wrap bg-white mb-30">
          <div class="fb-product-list_active-3 owl-carousel">

              @if (count($cat_section6->Category->Products) > 0)
                @foreach ($cat_section6->Category->Products->take(12)->chunk(3) as $productCollection)
                <div class="row">
                  @foreach ($productCollection as $product)
                  <!-- Begin Sigle Product Area -->
                  <div class="single-product {{ $loop->first ? 'pt-20' : '' }} {{ $loop->last ? 'pb-20' : '' }}">
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

                        <span class="new-price">&#2547;{{ $product->regular_price }}</span>
                        @else
                        <span class="new-price">&#2547;{{ $product->sell_price }}</span>

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
                </div>
                @endforeach
            @endif

          </div>
        </div>
      </div>
      @endif


      @if (isset($cat_section7))
      <div class="col-lg-4">
        <div class="fb-section_title-2">
          <h2>{{ $cat_section7->name }}</h2>
        </div>
        <div class="fb-single-product-slide_wrap bg-white mb-30">
          <div class="fb-product-list_active-3 owl-carousel">

              @if (count($cat_section7->Category->Products) > 0)
                @foreach ($cat_section7->Category->Products->take(12)->chunk(3) as $productCollection)
                <div class="row">
                  @foreach ($productCollection as $product)
                  <!-- Begin Sigle Product Area -->
                  <div class="single-product {{ $loop->first ? 'pt-20' : '' }} {{ $loop->last ? 'pb-20' : '' }}">
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

                        <span class="new-price">&#2547;{{ $product->regular_price }}</span>
                        @else
                        <span class="new-price">&#2547;{{ $product->sell_price }}</span>

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
                </div>
                @endforeach
            @endif

          </div>
        </div>
      </div>
      @endif

    </div>
  </div>
</div>
