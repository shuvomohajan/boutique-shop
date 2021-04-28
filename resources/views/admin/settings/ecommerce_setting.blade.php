@extends('admin.layouts.default')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <!--begin::Portlet-->
      <div class="kt-portlet">
        @if(session()->has('Smsg'))
        <div class="alert alert-success">
          {{session()->get('Smsg')}}
        </div>
        @elseif(session()->has('Fmsg'))
        <div class="alert alert-danger">
          {{session()->get('Fmsg')}}
        </div>
        @endif
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <span class="kt-widget__icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                    <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                  </g>
                </svg>
              </span>
            </span>
            <h3 class="kt-portlet__head-title">
              E-commerce Setting
            </h3>
          </div>
        </div>
        <!--begin::Form-->

        <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('ecommerce.update')}}">
          @csrf
          <div class="kt-portlet__body">

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="SSL_ID"><b>{{__('SslCommerz Store Id')}}</b></label>
                <input name="SSL_ID" id="SSL_ID" value="{{old('SSL_ID') ?? ($ecommerce_setting ? $ecommerce_setting->SSL_ID : null)}}"
                       placeholder="Ex: " type="text" class="form-control  @error('SSL_ID') is-invalid @enderror">
                @error('SSL_ID')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the SslCommerz Store Id.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="SSL_PASSWORD"><b>{{__('SslCommerz Store Password')}}</b></label>
                <input name="SSL_PASSWORD" id="SSL_PASSWORD" value="{{old('SSL_PASSWORD') ?? ($ecommerce_setting ? $ecommerce_setting->SSL_PASSWORD : null)}}"
                       placeholder="Ex: " type="text" class="form-control  @error('SSL_PASSWORD') is-invalid @enderror">
                @error('SSL_PASSWORD')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the SslCommerz Store Password.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="currency"><b>{{__('Currency')}}</b></label>
                <select class="form-control select2" id="currency" name="currency" value="{{ old('currency') ?? ($ecommerce_setting ?  $ecommerce_setting->currency : null) }}">
                  <option value="">-- Select Currency --</option>
                  <option value="BDT" {{ (old('currency') ?? ($ecommerce_setting ?  $ecommerce_setting->currency : null)) == 'BDT' ? 'selected' : null}}>BDT</option>
                </select>
                @error('currency')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the e-commerce currency.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <label for="shipping_cost_dhaka"><b>{{__('Shipping Cost In Dhaka')}}</b></label>
                <input name="shipping_cost_dhaka" id="shipping_cost_dhaka" min="0" value="{{old('shipping_cost_dhaka') ?? ($ecommerce_setting ? $ecommerce_setting->shipping_cost_dhaka : null)}}"
                  placeholder="Ex: 50" type="number" class="form-control  @error('shipping_cost_dhaka') is-invalid @enderror">
                @error('shipping_cost_dhaka')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the cost in dhaka.</span>
              </div>
              <div class="col-lg-4">
                <label for="shipping_cost_outside"><b>{{__('Shipping Cost Outside')}}</b></label>
                <input name="shipping_cost_outside" id="shipping_cost_outside" min="0"
                  value="{{old('shipping_cost_outside') ?? ($ecommerce_setting ?  $ecommerce_setting->shipping_cost_outside : null)}}" placeholder="Ex: 100" type="number"
                  class="form-control  @error('shipping_cost_outside') is-invalid @enderror">
                @error('shipping_cost_outside')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the cost outside dhaka.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="tax"><b>{{__('Tax')}}</b></label>
                <div class="input-group">
                  <input name="tax" id="tax" min="0" value="{{old('tax') ?? ($ecommerce_setting ?  $ecommerce_setting->tax : null)}}" placeholder="Ex: 5" type="number"
                    class="form-control  @error('tax') is-invalid @enderror">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
                @error('tax')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the cost in dhaka.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <label for="delivery_time_dhaka"><b>{{__('Delivery Time in Dhaka')}}</b></label>
                <input name="delivery_time_dhaka" id="delivery_time_dhaka" value="{{old('delivery_time_dhaka') ?? ($ecommerce_setting ?  $ecommerce_setting->delivery_time_dhaka : null)}}"
                  placeholder="Ex: 5" type="number" class="form-control  @error('delivery_time_dhaka') is-invalid @enderror">
                @error('delivery_time_dhaka')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the delivery time in dhaka.</span>
              </div>
              <div class="col-lg-4">
                <label for="delivery_time_outside"><b>{{__('Delivery Time Outside')}}</b></label>
                <input name="delivery_time_outside" id="delivery_time_outside" value="{{old('delivery_time_outside') ?? ($ecommerce_setting ?  $ecommerce_setting->delivery_time_outside : null)}}"
                  placeholder="Ex: 5" type="number" class="form-control @error('delivery_time_outside') is-invalid @enderror">
                @error('delivery_time_outside')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the delivery time outside.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="note"><b>{{__('Delivery Note')}}</b></label>
                <textarea name="note" id="note" rows="3" class="form-control  @error('note') is-invalid @enderror">{{old('note') ?? ($ecommerce_setting ?  $ecommerce_setting->note : null)}}</textarea>
                @error('note')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the cost in dhaka.</span>
              </div>
            </div>

          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-lg-6">
                  <!-- <button type="reset" class="btn btn-danger">Delete</button> -->
                </div>
                <div class="col-lg-6 kt-align-right">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!--end::Form-->
      </div>
      <!--end::Portlet-->
    </div>
  </div>
</div>
<script>
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo').css("background-image", "url("+ e.target.result + ")");

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

  function readFooterLogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#footer-logo').css("background-image", "url("+ e.target.result + ")");

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function ImageClear(id) {
        $(id).css("background-image", "url()");

    }
</script>
@endsection
