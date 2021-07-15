<div class="body-wrapper">
  <!-- Begin Header Area -->
  <!-- Header Area End Here -->
  <!-- Begin Slider With Banner Two Area -->
  <div class="slider-with-banner slider-with-banner-2 pt-30">
    <div class="container">
      <div class="row">
        <!-- Begin FB's Single Product Slide Wrap Area -->
        <div class="col-lg-3">
          <div class="fb-section_title-2">
            <h2>Top Sales</h2>
          </div>
          <div class="fb-single-product-slide_wrap bg-white">
            <div class="fb-single-product_active owl-carousel">
              <!-- Begin Sigle Product Area -->
              @foreach ($topsales as $product)
              @if ($product->total > 0)
              <div class="single-product" style="padding: 20px">
                <!-- Begin Product Image Area -->
                <div class="product-img">
                  <a href="{{ route('product.details',$product->id) }}"><img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}"
                      alt="FB'S Prduct" style="height: 333px; width: 100%; object-fit: cover;"></a>
                  @if(Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) < $days)<span class="sticker">New</span>@endif
                  @if($product->discount != null)<span class="sticker-2 text-dark">{{ $product->discount }}%</span>@endif
                </div>
                <!-- Product Image Area End Here -->
                <!-- Begin Product Content Area -->
                <div class="product-content">
                  <h2 class="product-name pt-3">
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
                  {{-- <div class="countersection-3 pt-10">
                                <div class="fb-countdown-3"></div>
                              </div> --}}
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
              @endif
              @endforeach
              <!-- Sigle Product Area End Here -->
            </div>
          </div>
        </div>

        <!-- Single Product Slide Area End Here -->
        <!-- Begin Slider Area -->
        <div class="col-lg-9">
          <div class="slider-area slider-area-3 pt-sm-30 pt-xs-30">
            <div class="slider-active owl-carousel">
              <!-- Begin Single Slide Area -->
              @foreach ($sliders as $slider)
              <div class="single-slide align-center-left animation-style-01 bg-5" style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                <div class="slider-progress"></div>
                <div class="slider-content">
                  @if($slider->title)<h2>{{ $slider->title }}</h2>@endif
                  @if($slider->title_mini)<h3>{{ $slider->title_mini }}</h3>@endif
                  @if($slider->button_name)
                  <div class="default-btn slide-btn">
                    <a class="fb-links w-auto px-4" href="{{ $slider->button_link }}">{{ $slider->button_name }}</a>
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
              <!-- Single Slide Area End Here -->
            </div>
          </div>
        </div>
        <!-- Slider Area End Here -->

        {{-- <div class="col-lg-3">
          <div class="row">
            @foreach ($featureCategories as $featuresCategory)
            <div class="col-lg-12 col-sm-6 p-1">
              <div class="fb-banner fb-img-hover-effect pt-sm-30 pt-xs-30">
                <a href="{{ route('all.products',['category',$featuresCategory->category_id]) }}">
                  <img src="{{ asset('storage/' . $featuresCategory->image) }}" alt="">
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div> --}}
      </div>
    </div>
  </div>
