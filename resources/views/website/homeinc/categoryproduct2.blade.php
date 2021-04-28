@if (isset($cat_section2))
  @if (count($cat_section2->Category->Products) > 0)
    <div class="fb-banner_with_list-product children-books pt-40 pb-40 pt-sm-0 pt-xs-0">
      <div class="container">
        <div class="fb-section_title-2">
          <h2>{{ $cat_section2->name }} </h2>
        </div>
        <div class="fb-product_list_nav">
          <div class="row no-gutters">
            <div class="col-xl-3 col-lg-4 col-md-5">
              <!-- Begin FB's Banner Area -->
              <div class="fb-banner fb-img-hover-effect">
                <a href="#">
                  <img src="{{asset('storage/'.$cat_section2->image) }}" alt="FB'S Banner">
                </a>
              </div>
              <!-- FB's Banner Area End Here -->
            </div>

            <div class="col-xl-9 col-lg-8 col-md-7">
              <!-- Begin FB's List Product Area -->
              <div class="fb-list_product">
                <div class="fb-list_product_active owl-carousel">
                  @foreach ($cat_section2->Category->Products->chunk(2) as $productCollection)
                    {{-- {{ dd($productCollection) }} --}}
                  <div class="row no-gutters">
                    <!-- Begin Sigle Product Area -->
                    @foreach ($productCollection as $product)
                    <div class="single-product list-single_product">
                      <!-- Begin Product Image Area -->
                      <div class="product-img list-product_img">
                        <a href="{{ route('product.details',$product->id) }}">
                          <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}" alt="FB'S Prduct">
                        </a>
                          @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) <= $days) <span class="sticker">New</span>
                          @endif
                          @if ($product->discount != null)

                          <span class="sticker-2 text-dark">{{ $product->discount }}%</span>

                          @endif
                      </div>
                      <!-- Product Image Area End Here -->
                      <!-- Begin Product Content Area -->
                      <div class="product-content list-product_content">
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
                        <div class="product-action list-product_action">
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
                  @endforeach
                </div>
              </div>
              <!-- FB's List Product Area End Here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endif
