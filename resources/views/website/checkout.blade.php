@extends('website.layouts.website')
@section('content')
  <!-- Begin Body Wraper Area -->
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
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Checkout</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FB's Breadcrumb Area End Here -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div>
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-30 pb-30">
      <form method="POST" action="" id="payForm">
        @csrf
        <div class="container">
          <div class="row">
            <div class="col-12">
              <table class="table">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Division</th>
                  <th>City</th>
                  <th>Area</th>
                  <th>Zip</th>
                  <th>Address</th>
                  <th>Contact</th>
                </tr>
                </thead>
                <tbody>
                @foreach(Auth::user()->ShippingAddress()->with('Division')->get() as $address)
                  <tr>
                    <td><input type="radio" name="shipping_address" id="address{{ $address->id }}" value="{{ $address->id }}"></td>
                    <td>{{ $address->Division->name }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->area }}</td>
                    <td>{{ $address->zip }}</td>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->contact }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="checkbox-form">
                {{-- <h3>Billing Details</h3> --}}
                <div class="different-address">
                  <div class="ship-different-title">
                    <h3>
                      <label for="shipping-box">Ship to a different address?</label>
                      <input id="shipping-box" type="radio" name="shipping_address" value="new_address">
                    </h3>
                  </div>
                  <div id="shipping-box-info" class="row" style="display:none">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="country-select clearfix">
                          <label>Country <span class="required">*</span></label>
                          <select class="nice-select wide" name="country">
                            <option value="Bangladesh">Bangladesh</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="country-select clearfix">
                          <label for="division">Division <span class="required">*</span></label>
                          <select class="nice-select wide" name="division_id" id="division">
                            <option value="" selected disabled> Select Division</option>
                            @foreach ($divisions as $division)
                              <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="checkout-form-list">
                          <label>City <span class="required">*</span></label>
                          <input type="text" name="city">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="checkout-form-list">
                          <label>Area <span class="required">*</span></label>
                          <input placeholder="" type="text" name="area">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="checkout-form-list">
                          <label>Zip <span class="required">*</span></label>
                          <input placeholder="" type="text" name="zip">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="checkout-form-list mb-30">
                          <label>Address <span class="required">*</span></label>
                          <input placeholder="Street address" type="text" name="address">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="checkout-form-list">
                          <label>Phone <span class="required">*</span></label>
                          <input type="text" name="contact">
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="order-notes">
                    <div class="checkout-form-list">
                      <label>Order Notes</label>
                      <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="your-order">
                <h3>Your order</h3>
                <div class="your-order-table table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th class="cart-product-name">Image</th>
                      <th class="cart-product-name">Product</th>
                      <th class="cart-product-total">Total</th>
                      <th class="cart-product-total">Action</th>
                    </tr>
                    </thead>
                    <tbody class="show-bag">

                    </tbody>
                    <tfoot>
                    <tr class="cart-subtotal">
                      <th>Cart Subtotal</th>
                      <td><span class="amount total-cart">£215.00</span></td>
                    </tr>
                    <tr class="order-total">
                      <th>Order Total</th>
                      <td><strong><span class="amount total-cart">£215.00</span></strong></td>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="payment-method">
                  <div class="payment-accordion">
                    <div id="accordion">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input pr-2 " name="payment_method" id="ssl" value="ssl">
                          SSL Commerz
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input pr-2" name="payment_method" id="cash" value="cash" checked>
                          Cash On Delivery
                        </label>
                      </div>
                      <div class="card pt-15">
                        <div class="card-header" id="#payment-2">
                          <h5 class="panel-title">
                            <input type="checkbox" class="mt-4 mr-2" id="terms"> <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Apply terms
                            </a>
                          </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our
                              account.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order-button-payment">
                      <input id="placeOrder" value="Place order" class="disabled" type="submit" disabled="disabled">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!--Checkout Area End-->
    <!-- Begin FB's Branding Area -->
    <!-- FB's Branding Area End Here -->
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
        data: {code: code, pid: pid, _token: "{{csrf_token()}}"},

        success: (function (res) {
          $('#coupon_result').html(res);
        })
      });
    });

    $(document).ready(function () {
      checkShippingBox();

      $('input[name=shipping_address]').on('click', function () {
        checkShippingBox();

        if ($('#terms').is(':checked')) {
          $('#placeOrder').removeAttr('disabled').removeClass('disabled');
        }

      });
      $('#terms').on('click', function () {
        if ($('#terms').is(':checked')) {

          // $('input[name=shipping_address]').on('click', function(){
          //   $('#placeOrder').attr('disabled','').removeClass('disabled');
          // });

          if ($('input[name=shipping_address]').is(':checked')) {
            $('#placeOrder').removeAttr('disabled').removeClass('disabled');

          }
        } else {
          $('#placeOrder').attr({disabled: 'disabled', title: 'Apply terms'}).addClass('disabled');
        }
      });


      if ($('input[name=shipping_address]').is(':checked')) {

        if ($('#terms').is(':checked')) {
          $('#placeOrder').removeAttr('disabled').removeClass('disabled');
        }
      }


      function checkShippingBox() {
        if (document.getElementById('shipping-box').checked == true) {
          $('#shipping-box-info').show();
        } else {
          $('#shipping-box-info').hide();
        }
      }

      if ($('#ssl').is(':checked')) {
        $('#payForm').attr('action', '{{ url('/pay') }}')
      }
      if ($('#cash').is(':checked')) {
        $('#payForm').attr('action', '{{ route('cash.store') }}')

      }
      $('input[name=payment_method]').on('click', function () {
        if ($('#ssl').is(':checked')) {
          $('#payForm').attr('action', '{{ url('/pay') }}')
        }
        if ($('#cash').is(':checked')) {
          $('#payForm').attr('action', '{{ route('cash.store') }}')

        }
      });

    })
  </script>
@endpush
