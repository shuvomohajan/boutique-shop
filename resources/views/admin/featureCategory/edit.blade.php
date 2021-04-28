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
              Edit Feature Category
            </h3>
          </div>
        </div>
        <!--begin::Form-->

        <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('feature-category.update',$featureCategory->id)}}">
          @csrf
          @method('PUT')
          <div class="kt-portlet__body">
            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="name"><b>{{__('Feature Category Name')}} <span class="text-danger">*</span></b></label>
                <input name="name" id="name" value="{{$featureCategory->name}}" placeholder="Ex: Smith Jones" type="text" class="form-control  @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="products_id"><b>{{__('Feature Category')}}</b></label>
                <select class="form-control select2"  name="category_id">
                  <option value="" >-- Select Feature Category --</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ $category->id == $featureCategory->Category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('products_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select Category  .</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <label for="status"><b>{{__('Status')}} <span class="text-danger">*</span></b></label>
                <select name="status" id="status" value="{{old('status')}}" class="custom-select  @error('status') is-invalid @enderror">
                  <option value="1" {{ $featureCategory->status ? "selected":'' }}>Active</option>
                  <option value="0" {{ !$featureCategory->status ? "selected":'' }}>Inactive</option>
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
              <div class="col-lg-8">
                <div>
                  <label for="image" class=""><b>{{__('Cover Image')}}</b></label>
                </div>
                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                  <div id="image" class="kt-avatar__holder_cover" style="background-image: url({{asset('storage/'.$featureCategory->image)}})"> </div>
                  <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                    <i class="fa fa-pen"></i>
                    <input type="file" class="@error('image') is-invalid @enderror" onchange="readURL(this)" name="image" accept=".png, .jpg, .jpeg">
                    <input type="text" value="{{$featureCategory->image}}" style="display: none" name="old_image">
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
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{route('feature-category.index')}}" class="btn btn-secondary">Cancel</a>
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
                $('#image').css("background-image", "url("+ e.target.result + ")");

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function ImageClear() {
        $('#image').css("background-image", "url()");

    }
</script>
@endsection
