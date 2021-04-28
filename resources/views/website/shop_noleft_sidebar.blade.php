@extends('website.layouts.website')
@section('content')
<div class="body-wrapper">
  <!-- Begin Header Area -->
  <!-- Header Area End Here -->
  <!-- Begin Li's Breadcrumb Area -->
  <div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">{!! $item->name !!}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Li's Breadcrumb Area End Here -->
  <!-- Begin Li's Content Wraper Area -->
  <div class="content-wraper">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 order-1 order-lg-2">
          <!-- Begin FB's Banner Area -->
          <div class="shoptopbar-heading">
            <h2>{{ $item->name }}</h2>
          </div>
          <!-- Li's Banner Area End Here -->
          <!-- shop-top-bar start -->
          <div class="shop-top-bar mt-25">
            <div class="shop-bar-inner">
              {{-- <div class="product-view-mode">
                <!-- shop-item-filter-list start -->
                <ul class="nav shop-item-filter-list" role="tablist">
                  <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i
                        class="fa fa-th"></i></a></li>
                  <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                </ul>
                <!-- shop-item-filter-list end -->
              </div> --}}
              <div class="toolbar-amount m-0">
                <span>There are {{ $products->count() }} products.</span>
              </div>
            </div>
            <!-- product-select-box start -->

            <!-- product-select-box end -->
          </div>
          <!-- shop-top-bar end -->
          <!-- shop-products-wrapper start -->
          @if($products->count() > 0)
          <div class="shop-products-wrapper bg-white mt-30 pb-60 pb-sm-30">
            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
              <div class="fb-product_wrap shop-product-area">
                <div class="row">
                  @foreach ($products as $product)
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Begin Sigle Product Area -->
                    <div class="single-product">
                      <!-- Begin Product Image Area -->
                      <div class="product-img">
                        <a href="product-details.html">
                          <img class="primary-img" src="{{$product->image ? asset('storage/' . $product->image) : asset('assets/frontend/Images/product/5_2.jpg')}}" alt="FB'S Prduct">
                          {{-- <img class="secondary-img" src="{{asset('assets/frontend/Images/product/5_2.jpg')}}" alt="FB'S Prduct"> --}}
                        </a>
                        {{-- <div class="sticker"><span>New</span></div>
                          <div class="sticker-2"><span>-10%</span></div> --}}
                      </div>
                      <!-- Product Image Area End Here -->
                      <!-- Begin Product Content Area -->
                      <div class="product-content">
                        <h2 class="product-name">
                          <a href="product-details.html">{{ $product->name }}</a>
                        </h2>
                        <div class="rating-box">
                          <ul class="rating">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li class="no-star"><i class="fa fa-star"></i></li>
                            <li class="no-star"><i class="fa fa-star"></i></li>
                          </ul>
                        </div>
                        <div class="price-box">
                          <span class="new-price">&#2547; {{ $product->sell_price ?? $product->regular_price }}</span>
                          @if ($product->sell_price)
                          <span class="old-price">&#2547; {{ $product->regular_price }} </span>
                          @endif
                        </div>
                        <div class="product-action">
                          <ul class="product-action-link">
                            <li class="shopping-cart_link"><a href="javascript:;" class="plus-btn ppb{{$product->id}} btn add-to-cart cartPlus cart{{$product->id}}" data-id="{{ $product->id }}" title="Shopping Cart"><i class="ion-bag"></i></a></li>
                            <input type="hidden" name="qty" class="qty{{ $product->id }}" data-qty=0>
                            {{-- <li class="quick-view-btn"><a href="#" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter"><i class="ion-eye"></i></a></li> --}}
                            
                          </ul>
                        </div>
                      </div>
                      <!-- Product Content Area End Here -->
                    </div>
                    <!-- Sigle Product Area End Here -->
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            {{ $products->links() }}
          </div>
          @else
          <div class="shop-products-wrapper bg-white mt-30 pb-sm-30">
            <h2 class="p-4 text-center">No Product Found</h2>
          </div>
          @endif
          <!-- shop-products-wrapper end -->
        </div>
      </div>
    </div>
  </div>

</div>
<!-- FB's Footer Area End Here -->
</div>
<!-- Body Wraper Area End Here -->
<!-- JS
============================================ -->
@endsection

@push('scripts')
<script>
  /* $(document).ready(function () {
      let total = 0;
      $('.addToCart').click(function(e){
        let id = $(this).attr('data-id');

        $.ajax({
          url: '{{ route('addToCart.cookies') }}',
          type: 'POST',
          data: {
            _token: $('input[name="_token"]').val(),
            product_id: id,
          },
          success: function(result) {
            let data = JSON.parse(result);

            // $('.cart-item-count').te
            total += data.sell_price ? data.sell_price : data.regular_price;
            $('.price-content .minicart-total').html("Total: <span>" + total + "</span>")

            let cartItem = `<li>
                              <a href="product-details.html" class="minicart-product-image">
                                <img src="{{asset('storage')}}/${data.image}" alt="FB's Thumbnail">
                                <span class="product-quantity">1x</span>
                              </a>
                              <div class="minicart-product-details">
                                <h6><a href="product-details.html">${data.name}</a></h6>
                                <span>${data.sell_price ? data.sell_price : data.regular_price}</span>
                              </div>
                              <button class="close" title="Remove">
                                <i class="fa fa-close"></i>
                              </button>
                          </li>`


            $('.minicart-product-list').append(cartItem);
          },
          error: function(error){
            alert('Item Not Found');
          }
        });
      });
  }); */
</script>
@endpush
