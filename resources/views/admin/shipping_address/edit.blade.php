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
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"/>
                  </g>
                </svg>
              </span>
            </span>
              <h3 class="kt-portlet__head-title">
                Edit Shipping Address
              </h3>
            </div>
          </div>
          <!--begin::Form-->

          <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('address.update', $address->id)}}">
            @csrf
            @method('PUT')
            <div class="kt-portlet__body">

              <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <label for="country"><b>{{__('Country')}}</b></label>
                  <select class="form-control select2" id="country" name="country" value="{{ old('country') ?? $address->country }}">
                    <option value="Bangladesh" {{ old('country', $address->country) == 'Bangladesh' ? 'selected' : null }}>Bangladesh</option>
                  </select>
                  @error('country')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                  <label for="division"><b>{{__('Division')}}</b></label>
                  <select class="form-control select2" id="division" name="division" value="{{ old('division') ?? $address->division_id }}">
                    @foreach($divisions as $division)
                      <option value="{{ $division->id }}" {{ old('division', $address->division_id) == $division->id ? 'selected' : null }}>{{ $division->name }}</option>
                    @endforeach
                  </select>
                  @error('division')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-lg-4">
                  <label for="city"><b>{{__('City')}} <span class="text-danger">*</span></b></label>
                  <input name="city" id="city" value="{{old('city', $address->city)}}" type="text" class="form-control  @error('city') is-invalid @enderror">
                  @error('city')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                  <label for="area"><b>{{__('Area')}} <span class="text-danger">*</span></b></label>
                  <input name="area" id="area" value="{{old('area', $address->area)}}" type="text" class="form-control  @error('area') is-invalid @enderror">
                  @error('area')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-lg-4">
                  <label for="zip"><b>{{__('Zip')}} <span class="text-danger">*</span></b></label>
                  <input name="zip" id="zip" value="{{old('zip', $address->zip)}}" type="text" class="form-control  @error('zip') is-invalid @enderror">
                  @error('zip')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <label for="address"><b>{{__('Address')}} <span class="text-danger">*</span></b></label>
                  <input name="address" id="address" value="{{old('address', $address->address)}}" type="text" class="form-control  @error('address') is-invalid @enderror">
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <label for="contact"><b>{{__('Phone')}} <span class="text-danger">*</span></b></label>
                  <input name="contact" id="contact" value="{{old('contact', $address->contact)}}" type="text" class="form-control  @error('contact') is-invalid @enderror">
                  @error('contact')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
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
                    <a href="{{route('address.index')}}" class="btn btn-secondary">Cancel</a>
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
@endsection
