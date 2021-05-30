@extends('website.layouts.website')
@section('content')
  <div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li class="active">Custom Product</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="content-wraper" style="margin-bottom: 50px">
    <div class="container">
      <div id="main">
        <section id="content" class="page-content card card-block">
          <section class="p-4">
            <form action="{{ route('custom_product.store') }}" method="post">
              @csrf
              <section class="form-fields ">
                <div class="form-group row">
                  <div class="col-md-9 col-md-offset-3">
                    <h3>Custom Product</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-9">

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label text-right" for="service">Product</label>
                      <div class="col-md-8">
                        <select name="service" id="service" class="custom-select">
                          <option value="Blouse">Blouse</option>
                          <option value="Kurta">Kurta</option>
                          <option value="Bottom">Bottom</option>
                          <option value="Salwar_Suit">Salwar Suit</option>
                        </select>
                        @error('service')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row" id="front_section">
                      <label class="col-md-3 form-control-label text-right" for="front">Front</label>
                      <div class="col-md-8">
                        <select name="front" id="front" class="custom-select">
                          <option data-image="{{ asset('storage/images/default.png') }}" value="Square with criss-cross neck">Square with criss-cross neck</option>
                          <option value="Square neck">Square neck</option>
                          <option value="Rectangle neck">Rectangle neck</option>
                          <option value="Stand-up Collar with Sweetheart neck">Stand-up Collar with Sweetheart neck</option>
                          <option value="Deep Sweetheart neck">Deep Sweetheart neck</option>
                          <option value="Horseshoe neck">Horseshoe neck</option>
                          <option value="Collar with Deep V-neck">Collar with Deep V-neck</option>
                          <option value="Round with V-neck">Round with V-neck</option>
                          <option value="Crew neck">Crew neck</option>
                          <option value="Boat neck">Boat neck</option>
                          <option value="U-Neck">U-Neck</option>
                          <option value="Diamond Neck">Diamond Neck</option>
                          <option value="V-Neck">V-Neck</option>
                          <option value="Peter Pan Collar">Peter Pan Collar</option>
                          <option value="Classic Shirt Collar">Classic Shirt Collar</option>
                          <option value="Scalloped neck">Scalloped neck</option>
                          <option value="High Collar">High Collar</option>
                          <option value="Spaghetti - U neck">Spaghetti - U neck</option>
                          <option value="Nehru Collar">Nehru Collar</option>
                          <option value="Spaghetti - Square neck">Spaghetti - Square neck</option>
                          <option value="Halter neck">Halter neck</option>
                          <option value="High collar halter neck">High collar halter neck</option>
                        </select>
                        @error('front')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row" id="back_section">
                      <label class="col-md-3 form-control-label text-right" for="back">Back</label>
                      <div class="col-md-8">
                        <select name="back" id="back" class="custom-select">
                          <option value="Square with criss-cross">Square with criss-cross</option>
                          <option value="Boat neck">Boat neck</option>
                          <option value="Fisheye keyhole">Fisheye keyhole</option>
                          <option value="Loop with button">Loop with button</option>
                          <option value="Drop shaped keyhole">Drop shaped keyhole</option>
                          <option value="Round neck">Round neck</option>
                          <option value="Square neck">Square neck</option>
                          <option value="U-neck">U-neck</option>
                          <option value="Peter Pan Collar">Peter Pan Collar</option>
                          <option value="Rectangle neck">Rectangle neck</option>
                          <option value="Collared back with fisheye keyhole">Collared back with fisheye keyhole</option>
                          <option value="V-neck">V-neck</option>
                          <option value="Crew neck">Crew neck</option>
                          <option value="Halter with straps at back">Halter with straps at back</option>
                          <option value="Collared back with strings">Collared back with strings</option>
                          <option value="Halter with back bustier">Halter with back bustier</option>
                          <option value="Backless with strings">Backless with strings</option>
                          <option value="Halter with strings at back">Halter with strings at back</option>
                          <option value="Collared back with straps">Collared back with straps</option>
                          <option value="Spaghetti - Square neck">Spaghetti - Square neck</option>
                          <option value="High Collar Halter Back">High Collar Halter Back</option>
                          <option value="Collared back">Collared back</option>
                          <option value="Sweetheart neck">Sweetheart neck</option>
                          <option value="Backless with straps">Backless with straps</option>
                          <option value="Classic Shirt collar">Classic Shirt collar</option>
                          <option value="Collared back with drop keyhole">Collared back with drop keyhole</option>
                          <option value="Spaghetti - U neck">Spaghetti - U neck</option>
                          <option value="Four Strings">Four Strings</option>
                          <option value="Scalloped neck">Scalloped neck</option>
                        </select>
                        @error('back')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    {{--Kurta--}}
                    <div class="form-group row" id="sleeve_section" style="display: none">
                      <label class="col-md-3 form-control-label text-right" for="sleeve">SLEEVE</label>
                      <div class="col-md-8">
                        <select name="sleeve" id="sleeve" class="custom-select">
                          <option value="Full sleeves">Full sleeves</option>
                          <option value="3/4th sleeves">3/4th sleeves</option>
                          <option value="Half sleeves">Half sleeves</option>
                          <option value="Short sleeve">Short sleeve</option>
                          <option value="Cap sleeve">Cap sleeve</option>
                          <option value="Sleeveless with thick shoulder strap">Sleeveless with thick shoulder strap</option>
                          <option value="Sleeveless with thin shoulder strap">Sleeveless with thin shoulder strap</option>
                          <option value="Puff sleeve">Puff sleeve</option>
                        </select>
                        @error('sleeve')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    {{--Kurta--}}
                    <div class="form-group row" id="hemline_section" style="display: none">
                      <label class="col-md-3 form-control-label text-right" for="hemline">HEMLINE</label>
                      <div class="col-md-8">
                        <select name="hemline" id="hemline" class="custom-select">
                          <option value="Mid-Thigh length Kurta">Mid-Thigh length Kurta</option>
                          <option value="Above knee length Kurta">Above knee length Kurta</option>
                          <option value="Knee length">Knee length</option>
                          <option value="Below knee length">Below knee length</option>
                          <option value="Ankle length">Ankle length</option>
                        </select>
                        @error('hemline')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    {{--Salwar & Bottom--}}
                    <div class="form-group row" id="style_section" style="display: none">
                      <label class="col-md-3 form-control-label text-right" for="style">STYLE</label>
                      <div class="col-md-8">
                        <select name="style" id="style" class="custom-select">
                          <option value="Churidar">Churidar</option>
                          <option value="Salwar">Salwar</option>
                          <option value="Pant">Pant</option>
                          <option value="Plain Plazo">Plain Plazo</option>
                          <option value="Patiala">Patiala</option>
                        </select>
                        @error('style')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row" id="note_section">
                      <label class="col-md-3 form-control-label text-right" for="note">Note</label>
                      <div class="col-md-8">
                        <textarea class="form-control" name="note" id="note" rows="4" placeholder="Note Here"></textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <b>Price</b>: <span id="price_amount">300</span>tk
                    <input type="hidden" name="price" id="price" value="300">

                  </div>
                </div>
              </section>
              <div class="form-group">
                <div class="text-right">
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Next</button>

                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Shipping Information</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-left">

                          @auth()
                          @foreach(Auth::user()->ShippingAddress()->with('Division')->get() as $address)
                            <p>
                              <input type="radio" class="custom-radio" name="shipping_address" id="address{{ $address->id }}" value="{{ $address->id }}">
                              <label for="address{{ $address->id }}">
                                {{ $address->Division->name }}, {{ $address->city }}, {{ $address->area }}, {{ $address->zip }}, {{ $address->address }}. ({{ $address->contact }})
                              </label>
                            </p>
                          @endforeach
                          @endauth

                            <div class="checkbox-form">
                              {{-- <h3>Billing Details</h3> --}}
                              <div class="different-address">
                                <div class="ship-different-title">
                                  <h5>
                                    <label for="shipping-box">Ship to a different address?</label>
                                    <input id="shipping-box" type="radio" name="shipping_address" value="new_address">
                                  </h5>
                                </div>
                                <div id="shipping-box-info" style="display:none">
                                  <input type="hidden" name="country" value="Bangladesh">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="country-select clearfix" style="margin-bottom: 5px">
                                        <label for="division">Division <span class="required">*</span></label>
                                        <select class="nice-select wide" name="division_id" id="division">
                                          <option value="" selected disabled> Select Division </option>
                                          @foreach (\App\Model\Division::all() as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="checkout-form-list" style="margin-bottom: 5px">
                                        <label>City <span class="required">*</span></label>
                                        <input type="text" name="city">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="checkout-form-list" style="margin-bottom: 5px">
                                        <label>Area <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="area">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="checkout-form-list" style="margin-bottom: 5px">
                                        <label>Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="zip">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkout-form-list" style="margin-bottom: 5px">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Street address" type="text" name="address">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkout-form-list" style="margin-bottom: 5px">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="contact">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-dark">Place Request</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </form>
          </section>
        </section>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $('#service').change(function () {
      let service = $(this).val();

      if (service === 'Blouse') {
        $('#front_section').slideDown('fast').find('select').removeProp('disabled');
        $('#back_section').slideDown('fast').find('select').removeProp('disabled');
        $('#sleeve_section').slideUp('fast').find('select').prop('disabled', true);
        $('#hemline_section').slideUp('fast').find('select').prop('disabled', true);
        $('#style_section').slideUp('fast').find('select').prop('disabled', true);
        $('#price_amount').text(300);
        $('#price').prop('value', 300)

      } else if (service === 'Kurta') {
        $('#front_section').slideDown('fast').find('select').removeProp('disabled');
        $('#back_section').slideDown('fast').find('select').removeProp('disabled');
        $('#sleeve_section').slideDown('fast').find('select').removeProp('disabled');
        $('#hemline_section').slideDown('fast').find('select').removeProp('disabled');
        $('#style_section').slideUp('fast').find('select').prop('disabled', true);
        $('#price_amount').text(500);
        $('#price').prop('value', 500)

      } else if (service === 'Bottom') {
        $('#front_section').slideUp('fast').find('select').prop('disabled', true);
        $('#back_section').slideUp('fast').find('select').prop('disabled', true);
        $('#sleeve_section').slideUp('fast').find('select').prop('disabled', true);
        $('#hemline_section').slideUp('fast').find('select').prop('disabled', true);
        $('#style_section').slideDown('fast').find('select').removeProp('disabled');
        $('#price_amount').text(200);
        $('#price').prop('value', 200)

      } else if (service === 'Salwar_Suit') {
        $('#front_section').slideDown('fast').find('select').removeProp('disabled');
        $('#back_section').slideDown('fast').find('select').removeProp('disabled');
        $('#sleeve_section').slideDown('fast').find('select').removeProp('disabled');
        $('#hemline_section').slideDown('fast').find('select').removeProp('disabled');
        $('#style_section').slideDown('fast').find('select').removeProp('disabled');
        $('#price_amount').text(1000);
        $('#price').prop('value', 1000)

      } else {
        console.log('Something wrong!')
      }
    });


    $(function () {
      checkShippingBox();

      $('input[name=shipping_address]').on('click', function () {
        checkShippingBox();
        if ($('#terms').is(':checked')) {
          $('#placeOrder').removeAttr('disabled').removeClass('disabled');
        }
      });

      $('#terms').on('click', function () {
        if ($('#terms').is(':checked')) {
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

    })
  </script>
@endpush
