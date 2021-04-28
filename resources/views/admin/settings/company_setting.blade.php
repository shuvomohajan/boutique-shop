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
              Company Setting
            </h3>
          </div>
        </div>
        <!--begin::Form-->

        <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('company.update')}}">
          @csrf
          <div class="kt-portlet__body">
            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="name"><b>{{__('Name')}} <span class="text-danger">*</span></b></label>
                <input name="name" id="name" value="{{old('name') ?? $company_setting->name}}" placeholder="Ex: " type="text" class="form-control  @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the company_setting name.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <label for="mobile1"><b>{{__('Mobile')}}</b></label>
                <input name="mobile1" id="mobile1" value="{{old('mobile1') ?? $company_setting->mobile1}}" placeholder="Ex: 01xxxxxxxxx" type="text"
                  class="form-control  @error('mobile1') is-invalid @enderror">
                @error('mobile1')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the mobile 1.</span>
              </div>
              <div class="col-lg-4">
                <label for="mobile2"><b>{{__('Mobile')}}</b></label>
                <input name="mobile2" id="mobile2" value="{{old('mobile2') ?? $company_setting->mobile2}}" placeholder="Ex: 01xxxxxxxxx" type="text"
                  class="form-control  @error('mobile2') is-invalid @enderror">
                @error('mobile2')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the mobile 2.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="email"><b>{{__('Email')}}</b></label>
                <input name="email" id="email" value="{{old('email') ?? $company_setting->email}}" placeholder="Ex: example@example.com" type="email"
                  class="form-control  @error('email') is-invalid @enderror">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the email.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="about"><b>{{__('About')}}</b></label>
                <textarea name="about" id="about" rows="4" placeholder="Ex: " type="about" class="form-control  @error('about') is-invalid @enderror">{{old('about') ?? $company_setting->about}}</textarea>
                @error('about')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the about.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="about_footer"><b>{{__('About Footer')}}</b></label>
                <textarea name="about_footer" id="about_footer" rows="4" placeholder="Ex: " type="about_footer" class="form-control  @error('about_footer') is-invalid @enderror">{{old('about_footer') ?? $company_setting->about_footer}}</textarea>
                @error('about_footer')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the about footer.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <label for="facebook"><b>{{__('Facebook Link')}}</b></label>
                <input name="facebook" id="facebook" min="0" value="{{old('facebook') ?? $company_setting->facebook}}" placeholder="Ex: " type="facebook"
                  class="form-control  @error('facebook') is-invalid @enderror">
                @error('facebook')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the facebook link.</span>
              </div>
              <div class="col-lg-4">
                <label for="twitter"><b>{{__('Twitter Link')}}</b></label>
                <input name="twitter" id="twitter" min="0" value="{{old('twitter') ?? $company_setting->twitter}}" placeholder="Ex: " type="twitter"
                  class="form-control  @error('twitter') is-invalid @enderror">
                @error('twitter')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the twitter link.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <label for="instagram"><b>{{__('Instagram Link')}}</b></label>
                <input name="instagram" id="instagram" min="0" value="{{old('instagram') ?? $company_setting->instagram}}" placeholder="Ex: " type="instagram"
                  class="form-control  @error('instagram') is-invalid @enderror">
                @error('instagram')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the instagram link.</span>
              </div>
              <div class="col-lg-4">
                <label for="whatsapp"><b>{{__('WhatsApp')}}</b></label>
                <input name="whatsapp" id="whatsapp" min="0" value="{{old('whatsapp') ?? $company_setting->whatsapp}}" placeholder="Ex: " type="whatsapp"
                  class="form-control  @error('whatsapp') is-invalid @enderror">
                @error('whatsapp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the whatsapp.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="location"><b>{{__('Location')}}</b></label>
                <input name="location" id="location" min="0" value="{{old('location') ?? $company_setting->location}}" placeholder="Ex: " type="location"
                  class="form-control  @error('location') is-invalid @enderror">
                @error('location')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the location.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <div>
                  <label for="logo" class=""><b>{{__('Logo')}}</b></label>
                </div>
                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                  <div id="logo" class="kt-avatar__holder" style="background-image: url({{asset('storage/'.$company_setting->logo)}})"> </div>
                  <label class="kt-avatar__upload" data-toggle="kt-tooltip1" title="" data-original-title="Change">
                    <i class="fa fa-pen"></i>
                    <input type="file" value="{{old('logo')}}" class="@error('logo') is-invalid @enderror" onchange="readURL(this)" name="logo" accept=".png, .jpg, .jpeg">
                  </label>
                  <span class="kt-avatar__cancel" data-toggle="kt-tooltip1" title="" onclick="ImageClear('#logo')" data-original-title="Cancel">
                    <i class="fa fa-times"></i>
                  </span>
                </div>
                @error('logo')
                <span style="display: block" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg. <br> Standard Resulation 940px X 720px (H x W). <br> Maximum size 512kb.</span>
              </div>

              <div class="col-lg-4">
                <div>
                  <label for="footer_logo" class=""><b>{{__('Footer Logo')}}</b></label>
                </div>
                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                  <div id="footer-logo" class="kt-avatar__holder" style="background-image: url({{asset('storage/'.$company_setting->footer_logo)}})"> </div>
                  <label class="kt-avatar__upload" data-toggle="kt-tooltip2" title="" data-original-title="Change">
                    <i class="fa fa-pen"></i>
                    <input type="file" value="{{old('footer_logo')}}" class="@error('footer_logo') is-invalid @enderror" onchange="readFooterLogoURL(this)" name="footer_logo"
                      accept=".png, .jpg, .jpeg">
                  </label>
                  <span class="kt-avatar__cancel" data-toggle="kt-tooltip2" title="" onclick="ImageClear('#footer-logo')" data-original-title="Cancel">
                    <i class="fa fa-times"></i>
                  </span>

                </div>
                @error('footer_logo')
                <span style="display: block" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg. <br> Standard Resulation 940px X 720px (H x W). <br> Maximum size 512kb.</span>
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
