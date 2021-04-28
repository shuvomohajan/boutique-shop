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
              Edit Tag
            </h3>
          </div>
        </div>
        <!--begin::Form-->

        <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('tag.update', $tag->id)}}">
          @csrf
          @method('PUT')
          <div class="kt-portlet__body">
            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="name" class=""><b>{{__('Tag Name')}} <span class="text-danger">*</span></b></label>
                <input name="name" id="name" value="{{old('name') ?? $tag->name}}" placeholder="Ex: " type="text" class="form-control  @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the tag name.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="status"<b>{{__('Status')}} <span class="text-danger">*</span></b></label>
                <select name="status" id="status" class="custom-select  @error('status') is-invalid @enderror">
                  <option value="1" selected>Active</option>
                  <option value="0" {{ (old('status') ?? $tag->status) ? null : 'selected' }}>Inactive</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please select the status.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-4">
                <div>
                    <label for="icon"><b>{{__('Tag Icon')}}</b></label>
                </div>
                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                    <div id="cvr_img" class="kt-avatar__holder_icon" style="background-image: url({{asset('storage/'.$tag->icon)}})" > </div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                        <i class="fa fa-pen"></i>
                        <input type="file"  class="@error('icon') is-invalid @enderror" onchange="readURL(this)" name="icon" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear()" data-original-title="Cancel">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                @error('icon')
                    <span style="display: block" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="form-text text-muted">Allowed file types:  png, jpg, jpeg. <br> Standard Resulation 940px X 720px (H x W). <br> Maximum size 512kb.</span>

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
                  <a href="{{route('tag.index')}}" class="btn btn-secondary">Cancel</a>
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
                $('#cvr_img').css("background-image", "url("+ e.target.result + ")");

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function ImageClear() {
        $('#cvr_img').css("background-image", "url()");

    }
</script>
@endsection
