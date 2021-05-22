@php
  $days = 7;
@endphp
@extends('website.layouts.website')
@section('content')

  <div class="body-wrapper">
    <div class="breadcrumb-area pt-30 pb-30">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-content">
              <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Product Details</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="product-details-area">
        <div class="container">
          <div class="pdetails bg-white">
            <div class="row">
              <div class="col-lg-5">
                <div class="pdetails-images">
                  <div class="pdetails-largeimages pdetails-imagezoom">
                    <div class="pdetails-singleimage"
                         data-src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}">
                      <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}"
                           alt="FB'S Prduct">
                    </div>
                    @if ($product->gallery != null)
                      @foreach (explode(',',$product->gallery) as $gallery)
                        <div class="pdetails-singleimage"
                             data-src="{{ asset('storage/' . ($gallery ? $gallery : 'images/default.png' )) }}">
                          <img class="primary-img" src="{{ asset('storage/' . ($gallery ? $gallery : 'images/default.png' )) }}"
                               alt="FB'S Prduct">
                        </div>
                      @endforeach
                    @endif
                  </div>

                  <div class="pdetails-thumbs">
                    <div class="pdetails-singlethumb">
                      <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}"
                           alt="FB'S Prduct">
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

                      @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) <= $days)
                        <div class="badge badge-success"><span>New</span></div>
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
                        <a href="javascript:;" class="fb-btn ppb{{ $product->id }} add-to-cart cartPlus cart{{ $product->id }}"
                           data-id="{{ $product->id }}" title="Shopping Cart">Add to cart</a> <span
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

      <div class="product-area pt-30">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="fb-product-tab">
                <ul class="nav fb-product-menu">
                  <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a>
                  </li>
                  <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
                </ul>
              </div>
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
                        {{--                    <li class="name">Pages :{{ $product->page }}</li>--}}
                      </ul>
                    </div>
                    <div class="col-lg-6">
                      <ul class="data-sheet">
                        {{--<li class="name">Format : {{ $product->format->name }}</li>
                        <li class="name">Year : {{ $product->year }}</li>
                        <li class="name">Language : {{ $product->language->name }}</li>--}}
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane pt-30 pb-30" role="tabpanel">
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

                <div class="modal fade modal-wrapper" id="mymodal">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <h3 class="review-page-title">Write Your Review</h3>
                        <div class="modal-inner-area row">
                          <div class="col-lg-6">
                            <div class="fb-review-product">
                              <img class="primary-img"
                                   src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png' )) }}"
                                   alt="FB'S Prduct">
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
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @foreach ($reviews as $review)
                  <div class="card mt-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                          <img src="{{ asset('storage/' . ($review->User->image ? $review->User->image : 'images/default_user.png')) }}"
                               class="img img-rounded img-fluid mb-2" width="50" style="border:0.5px solid gray;border-radius:50%"/>
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
    </div>
  </div>
@endsection
