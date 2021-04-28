@extends('website.layouts.website')
@section('content')
  <div class="breadcrumb-area pt-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">Cart</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FB's Breadcrumb Area End Here -->
  <!--Shopping Cart Area Strat-->
  <div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="#">
            <div class="table-content table-responsive">
              <table class="table">
                <thead>
                <tr>
                  <th class="fb-product-remove">remove</th>
                  <th class="fb-product-thumbnail">images</th>
                  <th class="cart-product-name">Product</th>
                  <th class="fb-product-price">Unit Price</th>
                  <th class="fb-product-quantity">Quantity</th>
                  <th class="fb-product-subtotal">Total</th>
                </tr>
                </thead>
                <tbody class="show-bag">
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="coupon-all">
                  <div class="coupon">
                    <input id="coupon_code" class="input-text code" name="coupon_code" value="" placeholder="Coupon code" type="text">
                    <span id="coupon_result"> </span>
                    <input type="hidden" value="" id="coupon">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 ml-auto">
                <div class="cart-page-total">
                  <h2>Cart totals</h2>
                  <ul>
<!--                    <li>Subtotal
                      <span class="total-cart"></span>
                      <span>&#2547;</span>
                    </li>-->
                    <li>Total
                      <span class="total-cart"></span>
                      <span>&#2547;</span>
                    </li>
                  </ul>
                  @if(Session::has('cart'))
                  <a href="{{ route('checkout') }}">Proceed to checkout</a>
                  @endif
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Shopping Cart Area End-->
  <!-- Begin FB's Footer Area -->

  <!-- FB's Footer Area End Here -->
  </div>
@endsection

<!-- Body Wraper Area End Here -->
<!-- JS
============================================ -->
<!-- jQuery JS -->


@push('scripts')
  <script>
    $(document).on('keyup', '.code', function () {
      //var total = $('#coupon').val();
      var code = $(this).val();
      var pid = $(this).attr('data-id');

      $.ajax({
        method: "POST",
        url: "{{route('cart.get_coupon')}}",
        data: {code: code, _token: "{{csrf_token()}}"},

        success: (function (res) {
          $('#coupon_result').html(res);
        })
      });
    })
  </script>
@endpush
