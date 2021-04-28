@php
$days = 7;
@endphp
@extends('website.layouts.website')
@section('content')

<div class="body-wrapper">
  <!-- Begin Header Area -->
  <!-- Header Area End Here -->
  <!-- Begin FB's Breadcrumb Area -->
  <div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">Product Details</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FB's Breadcrumb Area End Here -->
  <!-- Begin FB's Page Content Area -->
  <div class="page-content">
    <!-- Product Details Area -->
    <div class="product-details-area">
      <div class="container">
        <div class="pdetails bg-white">
          <div class="row">
            <div class="col-lg-5">
              <div class="pdetails-images">
                <div class="pdetails-largeimages pdetails-imagezoom">
                  <div class="pdetails-singleimage" data-src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}">
                    <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}" alt="FB'S Prduct">
                  </div>
                  @if ($product->gallery != null)
                    @foreach (explode(',',$product->gallery) as $gallery)
                    <div class="pdetails-singleimage" data-src="{{ asset('storage/' . ($gallery ? $gallery : 'images/default.png' )) }}">
                      <img class="primary-img" src="{{ asset('storage/' . ($gallery ? $gallery : 'images/default.png' )) }}" alt="FB'S Prduct">
                    </div>
                    @endforeach
                  @endif

                </div>

                <div class="pdetails-thumbs">
                  <div class="pdetails-singlethumb">
                    <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}" alt="FB'S Prduct">
                  </div>
                  @if ($product->gallery != null)
                  @foreach (explode(',',$product->gallery) as $gallery)
                  <div class="pdetails-singlethumb">
                    <img src="{{ asset('storage/' . ($gallery ? $gallery : 'images/default.png' )) }}" alt="product thumb">
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="product-details-view-content mt-20">
                <div class="product-info">
                  <h2>{{ $product->name }}</h2>
                  <span class="product-details-ref">SKU: {{ $product->sku }}</span>
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

                  <div class="price-box pb-10">
                    @if ($product->regular_price && $product->sell_price == null)

                    <span class="new-price">{{ $product->regular_price }}</span>
                    @else
                    <span class="new-price">{{ $product->sell_price }}</span>

                    <span class="old-price">{{ $product->regular_price }}</span>
                    @endif

                    @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) <= $days) <div class="badge badge-success"><span>New</span></div>
                  @endif
                  @if ($product->discount != null)
                  <div class="badge badge-danger">
                    <span>{{ $product->discount }}%</span>
                  </div>
                  @endif

                </div>
                @if ($product->short_description)
                <div class="product-desc">
                  <p>

                    <span>
                      {!! $product->short_description !!}
                    </span>
                  </p>
                </div>
                @endif
                <div class="single-add-to-cart">
                  <form action="#" class="cart-quantity mt-0">
                    {{-- <div class="quantity">
                                                    <label>Quantity</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="1" type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </div> --}}
                    <a href="javascript:;" class="fb-btn ppb{{ $product->id }} add-to-cart cartPlus cart{{ $product->id }}" data-id="{{ $product->id }}" title="Shopping Cart">Add to cart</a> <span
                      class="message text-danger"></span>
                  </form>
                </div>
                @if (($product->stock - $product->stock_out)  >= 1)
                <span class="product-availability pt-25">In stock</span>
                @else
                <span class="text-danger float-left pt-25">
                  <i class="fa fa-close"></i> Out of stock
                </span>
                @endif
                <div class="block-reassurance">
                  <ul>
                    <li>
                      <div class="reassurance-item">
                        <div class="reassurance-icon">
                          <i class="fa fa-check-square-o"></i>
                        </div>
                        <p>Security policy (edit with Customer reassurance module)</p>
                      </div>
                    </li>
                    <li>
                      <div class="reassurance-item">
                        <div class="reassurance-icon">
                          <i class="fa fa-truck"></i>
                        </div>
                        <p>Delivery policy (edit with Customer reassurance module)</p>
                      </div>
                    </li>
                    <li>
                      <div class="reassurance-item">
                        <div class="reassurance-icon">
                          <i class="fa fa-exchange"></i>
                        </div>
                        <p> Return policy (edit with Customer reassurance module)</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product Details Area End Here -->
  <!-- Begin Product Area -->
  <div class="product-area pt-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="fb-product-tab">
            <ul class="nav fb-product-menu">
              <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a>
              </li>
              <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
              {{-- <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li> --}}
            </ul>
          </div>
          <!-- Begin FB's Tab Menu Content Area -->
        </div>
      </div>
      <div class="tab-content">
        <div id="description" class="tab-pane active show" role="tabpanel">
          <div class="product-description">
            <span>
              {!! $product->full_description !!}
            </span>
          </div>
        </div>
        <div id="product-details" class="tab-pane" role="tabpanel">
          <div class="product-details-manufacturer">
            <p><span>SKU : </span> {{ $product->sku }}</p>
            <p class="in-stock"><span>in Stock</span> {{ $product->stock ?? 'No' }} Items</p>
            <div class="pdetails-features pt-10">
              <h3>Data sheet</h3>
              <div class="row">
                <div class="col-lg-6">
                  <ul class="data-sheet">
                    <li class="name">Author : {{ $product->Author->name }}</li>
                    <li class="name">Publisher : {{ $product->Publisher->name }}</li>
                    <li class="name">Pages :{{ $product->page }}</li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="data-sheet">
                    <li class="name">Format : {{ $product->format->name }}</li>
                    <li class="name">Year : {{ $product->year }}</li>
                    <li class="name">Language : {{ $product->language->name }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="tab-pane pt-30" role="tabpanel">
          <div class="product-reviews">
            <div class="product-details-comment-block">
              <div class="review-btn">
                @if (Auth::user())
                @if (count($product->Reviews) <= 0)
                  @php
                    $buttonmssg='Be the first to write your review !'
                  @endphp
                @else
                  @php
                    $buttonmssg='write your review !'
                  @endphp
                @endif

                @if (App\Model\Review::where('product_id',$product->id)->where('user_id',Auth::id())->count() == 0)
                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">
                {{ $buttonmssg }}
                </a>
                @else
                @endif
                  @endif
              </div>
              <!-- Begin Quick View | Modal Area -->
              <div class="modal fade modal-wrapper" id="mymodal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h3 class="review-page-title">Write Your Review</h3>
                      <div class="modal-inner-area row">
                        <div class="col-lg-6">
                          <div class="fb-review-product">
                            <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}" alt="FB'S Prduct">
                            <div class="fb-review-product-desc">
                              <p class="fb-product-name">{{ $product->name }}</p>
                              <p>
                                <span> {!! $product->short_description !!} </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="fb-review-content">
                            <!-- Begin Feedback Area -->
                            <div class="feedback-area">
                              <div class="feedback">
                                <h3 class="feedback-title">Our Feedback</h3>
                                <form action="{{ route('review.store') }}" method="POST" id="myform">
                                  @csrf
                                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                                  <p class="your-opinion">
                                    <label>Your Rating</label>
                                    <span>
                                      <select class="star-rating" name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                    </span>
                                  </p>
                                  <p class="feedback-form">
                                    <label for="feedback">Your Review</label>
                                    <textarea id="feedback" name="feedback" cols="45" rows="8" aria-required="true"></textarea>
                                  </p>
                                  <div class="feedback-btn pb-15">
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                    <a onclick="document.getElementById('myform').submit();">Submit</a>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <!-- Feedback Area End Here -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Quick View | Modal Area End Here -->

                @foreach ($reviews as $review)
                <div class="card mt-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <img src="{{ asset('storage/' . ($review->User->image ? $review->User->image : 'images/default_user.png')) }}" class="img img-rounded img-fluid mb-2" width="50" style="border:0.5px solid gray;border-radius:50%"/>
                        <p class="text-secondary">{{ Illuminate\Support\Carbon::parse($review->created_at)->diffForHumans()}}</p>
                      </div>
                      <div class="col-md-10">
                        <p>
                          <h5 class="float-left"><strong>{{ $review->User->name }}</strong></h5>
                          <div class="rating-box float-right">
                            <ul class="rating">
                                <li class="{{ $review->rating >= 1 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                                <li class="{{ $review->rating >= 2 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                                <li class="{{ $review->rating >= 3 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                                <li class="{{ $review->rating >= 4 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                                <li class="{{ $review->rating >= 5 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                            </ul>
                        </div>

                        </p>
                        <div class="clearfix"></div>
                        <p>
                          {{ $review->feedback }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

            </div>
          </div>
        </div>
    </div>
  </div>
  <!-- Product Area End Here -->
  <!-- Begin FB's Product With Banner Area -->
  <div class="fb-product_with_banner fb-featured-pro_with_banner other-product pt-60 pb-60">
    <div class="container">
      <div class="other-product-nav bg-white">
        <div class="fb-section_title-2">
          <h2>Related Product</h2>
        </div>
        <div class="row no-gutters">
          <!-- Begin FB's Product Wrap Area -->
          <div class="col-lg-12">
            <div class="fb-product_wrap bg-white mt-sm-60 mt-xs-60">
              <div class="fb-other-product_active owl-carousel">
                <!-- Begin Sigle Product Area -->
                @foreach ($relatedProducts->except($product->id) as $product)
                <div class="single-product">
                  <!-- Begin Product Image Area -->
                  <div class="product-img">
                    <a href="{{ route('product.details', $product->id) }}">
                      <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}" alt="FB'S Prduct">
                    </a>
                    @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) <= $days) <div class="sticker"><span>New</span></div>
                  @endif
                  @if ($product->discount != null)
                  <div class="sticker-2 text-dark">
                    <span>{{ $product->discount }}%</span>
                  </div>
                  @endif
                </div>
                <!-- Product Image Area End Here -->
                <!-- Begin Product Content Area -->
                <div class="product-content">
                  <h2 class="product-name">
                    <a href="single-product">{{ $product->name }}</a>
                  </h2>
                  <div class="rating-box">
                    <ul class="rating">
                      <li class="no-star"><i class="fa fa-star"></i></li>
                      <li class="no-star"><i class="fa fa-star"></i></li>
                      <li class="no-star"><i class="fa fa-star"></i></li>
                      <li class="no-star"><i class="fa fa-star"></i></li>
                      <li class="no-star"><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="price-box-2">
                    @if ($product->regular_price && $product->sell_price == null)

                    <span class="new-price">{{ $product->regular_price }}</span>
                    @else
                    <span class="new-price">{{ $product->sell_price }}</span>

                    <span class="old-price">{{ $product->regular_price }}</span>
                    @endif
                    @if (($product->stock - $product->stock_out) < 1) <h6 class="text-danger float-right border p-1">
                      Out of stock
                      </h6>
                      @endif
                  </div>
                  <div class="product-action">
                    <ul class="product-action-link">
                      <li class="shopping-cart_link"><a href="javascript:;" class="plus-btn ppb{{ $product->id }} btn add-to-cart cartPlus cart{{ $product->id }}" data-id="{{ $product->id }}"
                          title="Shopping Cart"><i class="ion-bag"></i></a></li>
                      <li class="quick-view-btn"><a href="#" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li>
                      <li class="single-product_link"><a href="single-product.html" title="Single Product"><i class="ion-link"></i></a></li>
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
        <!-- FB's Product Wrap Area End Here -->
      </div>
    </div>
  </div>
</div>
<!-- FB's Product Area End Here -->
</div>
<!-- Fb's Page Content Area End Here -->
<!-- Begin FB's Branding Area -->
{{-- <div class="fb-branding-wrap pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="fb-branding bg-white">
                            <div class="fb-branding_active owl-carousel">
                                <div class="branding-item">
                                    <a href="#">
                                        <img src="{{ asset('/') }}website/Images/branding/1.jpg" alt="FB's Branding">
</a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/2.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/3.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/4.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/5.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/6.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/1.jpg" alt="FB's Branding">
  </a>
</div>
<div class="branding-item">
  <a href="#">
    <img src="{{ asset('/') }}website/Images/branding/2.jpg" alt="FB's Branding">
  </a>
</div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
<!-- FB's Branding Area End Here -->
<!-- Begin FB's Footer Area -->
<!-- FB's Footer Area End Here -->
<!-- Begin Fb's Quick View | Modal Area -->

<!-- Fb's Quick View | Modal Area End Here -->
</div>
<!-- Body Wraper Area End Here -->
<!-- JS
                                                    ============================================ -->
<!-- jQuery JS -->

@endsection
