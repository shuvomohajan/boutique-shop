@extends('admin.layouts.default')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet kt-portlet--mobile">
    <!--begin::Portlet-->
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
          Add New
        </h3>
      </div>
    </div>

    <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST" action="{{route('product.update', $product->id)}}">
      @csrf
      @method('PUT')
      <div class="kt-portlet__body">
        <div class="row">
          <div class="col-lg-7">
            <div class="form-group">
              <label for="name"><b>{{__('Product Name')}}</b></label>
              <input name="name" id="name" value="{{old('name') ?? $product->name}}" placeholder="Ex: " type="text" class="form-control  @error('name') is-invalid @enderror">
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Please enter the Product Name.</span>
            </div>

            <div class="form-group">
              <label for="sku"><b>{{__('Sku')}}</b></label>
              <input name="sku" id="sku" value="{{old('sku') ?? $product->sku}}" placeholder="Ex: #P202173674" type="text" class="form-control  @error('sku') is-invalid @enderror">
              @error('sku')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Please enter the Product Sku.</span>
            </div>

            <div class="form-group">
              <label for="short_description"><b>{{__('Short description')}}</b></label>
              <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" placeholder="Enter a product Short Description..." minlength="40"
                maxlength="1000" rows="3">{{old('short_description') ?? $product->short_description}}</textarea>
              @error('short_description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Please enter a Short Description within text length range 100 and 1000.</span>
            </div>

            <div class="form-group">
              <label for="full_description"><b>{{__('Full Description')}}</b></label>
              <textarea class="form-control @error('full_description') is-invalid @enderror" name="full_description" placeholder="Enter a product Full Description..." minlength="100" maxlength="1000"
                rows="5">{{old('full_description') ?? $product->full_description}}</textarea>
              @error('full_description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Please enter a Full Description within text length range 100 and 1000.</span>
            </div>

            <div class="form-group row">
              <div class="col-lg-12">
                <label for="category_id"><b>{{__('product Category')}}</b></label>
                <select class="form-control select2-withTag" multiple name="category_id[]" value="{{ old('category_id') ?? $product->Categories }}" id="category_id" onchange="subcategoryFunction()">
                  <option value="">-- Select product Category --</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ $product->Categories->contains($category->id) ? 'selected' : null }}>{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                <span style="display: block" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product Category.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-12">
                <label for="subcategory_id"><b>{{__('Sub Category')}} <span class="text-danger">*</span></b></label>
                <select class="form-control select2-withTag" multiple value="{{ old('subcategory_id') ?? $product->subcategory_id }}" name="subcategory_id[]" value="{{ old('subcategory_id') ?? $product->Subcategories }}" id="subcategory_id">
                  @foreach ($product->Subcategories as $oldSubcategory)
                  <option value="{{ $oldSubcategory->id }}" {{ $product->Subcategories->contains($oldSubcategory->id) ? 'selected' : null }}>{{ $oldSubcategory->name }}</option>
                  @endforeach
                </select>
                @error('subcategory_id')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
                @enderror
                <span class="form-text text-muted">Select product Category.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-12">
                <label for="subject_id"><b>{{__('product Subject')}}</b></label>
                <select class="form-control select2-withTag" name="subject_id" value="{{ old('subject_id') ?? $product->subject_id }}">
                  <option value="">-- Select product subject --</option>
                  @foreach ($subjects as $subject)
                  <option value="{{ $subject->id }}" {{ (old('subject_id') ?? $product->subject_id) == $subject->id ? 'selected' : null }}>{{ $subject->name }}</option>
                  @endforeach
                </select>
                @error('subject_id')
                <span style="display: block" class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product subject.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-6">
                <label for="tag_id"><b>{{__('Tags')}}</b></label>
                <select class="form-control select2-withTag" multiple name="tag_id[]" value="{{ old('tag_id') ?? $oldTags }}">
                  <option value="">-- Select product Tag --</option>
                  @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}" {{ $oldTags->contains($tag->id) ? 'selected' : null }}>{{ $tag->name }}</option>
                  @endforeach
                </select>
                @error('tag_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product Tags.</span>
              </div>

              <div class="col-lg-6">
                <label for="year"><b>{{__('Year Published')}}</b></label>
                <select class="form-control select2-withTag" name="year" value="{{ old('year') ?? $product->year }}">
                  <option value="">-- Select year published --</option>
                  @for($i = date("Y"); $i >= 1800; $i--)
                  <option value="{{ $i }}" {{ (old('year') ?? $product->year) == $i ? 'selected' : null }}>{{ $i }}</option>
                  @endfor
                </select>
                @error('year')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product Year Published.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-6">
                <label for="format_id"><b>{{__('Product Format')}}</b></label>
                <select class="form-control select2" name="format_id" value="{{ old('format_id') ?? $product->format_id }}">
                  <option value="">-- Select product format --</option>
                  @foreach ($formats as $format)
                  <option value="{{ $format->id }}" {{ (old('format_id') ?? $product->format_id) == $format->id ? 'selected' : null }}>{{ $format->name }}</option>
                  @endforeach
                </select>
                @error('format_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product format.</span>
              </div>

              <div class="col-lg-6">
                <label for="language_id"><b>{{__('Product Language')}}</b></label>
                <select class="form-control select2-withTag" name="language_id" value="{{ old('language_id') ?? $product->language_id }}">
                  <option value="">-- Select product Tag --</option>
                  @foreach ($languages as $language)
                  <option value="{{ $language->id }}" {{ (old('language_id') ?? $product->language_id) == $language->id ? 'selected' : null }}>{{ $language->name }}</option>
                  @endforeach
                </select>
                @error('language_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Select product language.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-6">
                <label for="stock"><b>{{__('Product Stock')}}</b></label>
                <input name="stock" id="stock" value="{{old('stock') ?? $product->stock}}" placeholder="Ex: 1 " type="number" class="form-control  @error('stock') is-invalid @enderror">
                @error('stock')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the Product Stock.</span>
              </div>

              <div class="col-lg-6">
                <label for="page"><b>{{__('Pages')}}</b></label>
                <input name="page" id="page" value="{{old('page') ?? $product->page}}" placeholder="Ex: 100 " type="number" class="form-control  @error('page') is-invalid @enderror">
                @error('page')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the Product Pages.</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-4">
                <label for="regular_price"><b>{{__('Regular Price')}}</b></label>
                <input name="regular_price" id="regular_price" value="{{old('regular_price') ?? $product->regular_price}}" placeholder="Ex: 1 " type="number"
                  class="form-control  @error('regular_price') is-invalid @enderror">
                @error('regular_price')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the Product Regular Price.</span>
              </div>

              <div class="col-lg-4">
                <label for="sell_price"><b>{{__('Sell Price')}}</b></label>
                <input name="sell_price" id="sell_price" value="{{old('sell_price') ?? $product->sell_price}}" placeholder="Ex: 100 " type="number"
                  class="form-control  @error('sell_price') is-invalid @enderror">
                @error('sell_price')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the Product Sell Price.</span>
              </div>

              <div class="col-lg-4">
                <label for="discount"><b>{{__('Discount Price')}}</b></label>
                <div class="input-group">
                  <input name="discount" id="discount" onkeyup="showSellPrice()" onchange="showSellPrice()" value="{{old('discount') ?? $product->discount}}" min="0" placeholder="Ex: 5" type="number" class="form-control  @error('discount') is-invalid @enderror">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
                @error('discount')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="form-text text-muted">Please enter the Product Discount.</span>
              </div>
            </div>

            <div class="form-group">
              <label for="seo_key_word"><b>{{__('Key Words')}}</b></label>
              <select class="form-control select2-withTag" multiple name="seo_key_word[]" value="{{ old('seo_key_word') ?? $old_seo_key_word }}">
                <option value="">-- Select key words --</option>
                @foreach ($old_seo_key_word as $keyWord)
                <option value="{{ $keyWord }}" {{ (old('seo_key_word') ?? $old_seo_key_word)->contains($keyWord) ? 'selected' : null }}>{{ $keyWord }}</option>
                @endforeach
              </select>
              @error('seo_key_word')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Select product Tags.</span>
            </div>

            <div class="form-group">
              <div>
                <label for="image" class=""><b>{{__('Product Image')}}</b></label>
              </div>
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="image" class="kt-avatar__holder_icon" style="background-image: url({{asset('storage/'.$product->image)}})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('image') is-invalid @enderror" onchange="readURL(this, '#image')" name="image" accept=".png, .jpg, .jpeg">
                  <input type="text" value="{{$product->image}}" style="display: none" name="old_image">
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

            <div class="form-group">
              <div>
                <label for="social_image" class=""><b>{{__('Social Image')}}</b></label>
              </div>
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="social_image" class="kt-avatar__holder_cover" style="background-image: url({{asset('storage/'.$product->social_image)}})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('social_image') is-invalid @enderror" onchange="readURL(this, '#social_image')" name="social_image" accept=".png, .jpg, .jpeg">
                  <input type="text" value="{{$product->social_image}}" style="display: none" name="old_social_image">
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#social_image')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('social_image')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Allowed file types: png, jpg, jpeg. <br> Standard Resulation 940px X 720px (H x W). <br> Maximum size 512kb.</span>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="form-group">
              <label for="author_id"><b>{{__('Author')}}</b></label>
              <select class="form-control select2" name="author_id" value="{{ old('author_id') ?? $product->author_id }}">
                <option value="">-- Select Author --</option>
                @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ (old('author_id') ?? $product->author_id) == $author->id ? 'selected' : null }}>{{ $author->name }}</option>
                @endforeach
              </select>
              @error('author_id')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Select Author.</span>
            </div>

            <div class="form-group">
              <label for="publisher_id"><b>{{__('Publisher')}}</b></label>
              <select class="form-control select2" name="publisher_id" value="{{ old('publisher_id') ?? $product->publisher_id }}">
                <option value="">-- Select Publisher --</option>
                @foreach ($publishers as $publisher)
                <option value="{{ $publisher->id }}" {{ (old('publisher_id') ?? $product->publisher_id) == $publisher->id ? 'selected' : null }}>{{ $publisher->name }}</option>
                @endforeach
              </select>
              @error('publisher_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <span class="form-text text-muted">Select Publisher</span>
            </div>

            <div class="form-group row">
              @foreach ($features as $feature)
              <div class="col-lg-6">
                <label class="checkbox">
                  <input name="features[]" value="{{ $feature->id }}" {{ (old($feature->id) ?? $oldFeatures->contains($feature->id)) ? "checked" : null }} type="checkbox" class=" @error($feature->id) is-invalid @enderror">
                  <b class="ml-2">{{__( $feature->name )}}</b>
                </label>
                @error($feature->id)
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 col-md-4 col-lg-2">
            <div class="form-group">
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="gallery1" class="kt-avatar__holder_icon" style="background-image: url({{ isset($old_gallery[0]) ? asset('storage/'.$old_gallery[0]) : null }})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('gallery') is-invalid @enderror" onchange="readURL(this, '#gallery1')" name="gallery[]" accept=".png, .jpg, .jpeg">
                  {{-- <input type="text" value="{{ isset($old_gallery[0]) ? $old_gallery[0] : null }}" style="display: none" name="old_gallery[]"> --}}
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#gallery1')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('gallery')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="form-group">
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="gallery2" class="kt-avatar__holder_icon" style="background-image: url({{ isset($old_gallery[1]) ? asset('storage/'.$old_gallery[1]) : null }})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('gallery') is-invalid @enderror" onchange="readURL(this, '#gallery2')" name="gallery[]" accept=".png, .jpg, .jpeg">
                  {{-- <input type="text" value="{{ isset($old_gallery[1]) ? $old_gallery[1] : null }}" style="display: none" name="old_gallery[]"> --}}
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#gallery2')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('gallery')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="form-group">
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="gallery3" class="kt-avatar__holder_icon" style="background-image: url({{ isset($old_gallery[2]) ? asset('storage/'.$old_gallery[2]) : null }})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('gallery') is-invalid @enderror" onchange="readURL(this, '#gallery3')" name="gallery[]" accept=".png, .jpg, .jpeg">
                  {{-- <input type="text" value="{{ isset($old_gallery[2]) ? $old_gallery[2] : null }}" style="display: none" name="old_gallery[]"> --}}
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#gallery3')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('gallery')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="form-group">
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="gallery4" class="kt-avatar__holder_icon" style="background-image: url({{ isset($old_gallery[3]) ? asset('storage/'.$old_gallery[3]) : null }})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('gallery') is-invalid @enderror" onchange="readURL(this, '#gallery4')" name="gallery[]" accept=".png, .jpg, .jpeg">
                  {{-- <input type="text" value="{{ isset($old_gallery[3]) ? $old_gallery[3] : null }}" style="display: none" name="old_gallery[]"> --}}
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#gallery4')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('gallery')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="form-group">
              <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                <div id="gallery5" class="kt-avatar__holder_icon" style="background-image: url({{ isset($old_gallery[4]) ? asset('storage/'.$old_gallery[4]) : null }})"> </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change">
                  <i class="fa fa-pen"></i>
                  <input type="file" class="@error('gallery') is-invalid @enderror" onchange="readURL(this, '#gallery5')" name="gallery[]" accept=".png, .jpg, .jpeg">
                  {{-- <input type="text" value="{{ isset($old_gallery[4]) ? $old_gallery[4] : null }}" style="display: none" name="old_gallery[]"> --}}
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" onclick="ImageClear('#gallery5')" data-original-title="Cancel">
                  <i class="fa fa-times"></i>
                </span>
              </div>
              @error('gallery')
              <span style="display: block" class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
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
              <a href="{{route('product.index')}}" class="btn btn-secondary">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
    let regular_price = document.getElementById('regular_price');
    let sell_price = document.getElementById('sell_price');
    let discount = document.getElementById('discount');

    function showDiscount(){
      discount.value = (regular_price.value - sell_price.value) / (regular_price.value * 0.01)
    }
    function showSellPrice(){
      sell_price.value = regular_price.value - (regular_price.value * (discount.value/100))
    }

    //sub category
    let subcategoryFunction = function(){
      let category_id = $('#category_id').select2("val");
      $.ajax({
        method:"post",
        url:"{{ route('load.subcategory') }}",
        data:{category_id:category_id,"_token":"{{ csrf_token() }}"},
        dataType:"html",
        success:function(response){
          $("#subcategory_id").attr("disabled", false);
          $("#subcategory_id").html(response);
        },
        error:function(err){
          console.log(err);
        }
      });
    };

  function readURL(input, id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

			reader.onload = function (e) {
				$(id).css("background-image", "url("+ e.target.result + ")");
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function ImageClear(id) {
		$(id).css("background-image", "url()");
	}
</script>
@endsection
