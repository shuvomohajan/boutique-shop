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
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                     class="kt-svg-icon">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"/>
                  </g>
                </svg>
              </span>
            </span>
              <h3 class="kt-portlet__head-title">
                Add New Slider
              </h3>
            </div>
          </div>
          <!--begin::Form-->

          <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('slider.store')}}">
            @csrf
            <div class="kt-portlet__body">
              <div class="form-group row">
                <div class="col-lg-6">
                  <div>
                    <label for="image" class=""><b>{{__('Slider Image')}}</b></label>
                  </div>
                  <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                    <div id="image" class="kt-avatar__holder_cover"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                      <i class="fa fa-pen"></i>
                      <input type="file" value="{{old('image')}}" class="@error('image') is-invalid @enderror" onchange="readURL(this)" name="image"
                             accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#image')" data-original-title="Cancel">
                    <i class="fa fa-times"></i>
                  </span>
                  </div>
                  @error('image')
                  <span style="display: block" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-6">
                  <label for="title"><b>{{__('Title')}} <span class="text-danger">*</span></b></label>
                  <input name="title" id="title" value="{{old('title')}}" type="text"
                         class="form-control  @error('title') is-invalid @enderror">
                  @error('title')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
                <div class="col-lg-6">
                  <label for="title_mini"><b>{{__('Title Mini')}} <span class="text-danger">*</span></b></label>
                  <input name="title_mini" id="title_mini" value="{{old('title_mini')}}" type="text"
                         class="form-control  @error('title_mini') is-invalid @enderror">
                  @error('title_mini')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-4">
                  <label for="button_name"><b>{{__('Button Name')}} <span class="text-danger">*</span></b></label>
                  <input name="button_name" id="button_name" value="{{old('button_name')}}" type="text"
                         class="form-control  @error('button_name') is-invalid @enderror">
                  @error('button_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
                <div class="col-lg-4">
                  <label for="button_link"><b>{{__('Button Link')}} <span class="text-danger">*</span></b></label>
                  <input name="button_link" id="button_link" value="{{old('button_link')}}" type="text"
                         class="form-control  @error('button_link') is-invalid @enderror">
                  @error('button_link')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
                <div class="col-lg-4">
                  <label for="status"><b>{{__('Status')}} <span class="text-danger">*</span></b></label>
                  <select name="status" id="status" value="{{old('status')}}" class="custom-select  @error('status') is-invalid @enderror">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                  @error('status')
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('slider.index')}}" class="btn btn-secondary">Cancel</a>
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
        let reader = new FileReader();
        reader.onload = function (e) {
          $('#image').css("background-image", "url(" + e.target.result + ")");
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    function ImageClear() {
      $('#image').css("background-image", "url()");
    }
  </script>
@endsection
