@php
$days = 7;
@endphp
@extends('website.layouts.website')
@section('content')
<div class="body-wrapper">
  <div class="breadcrumb-area pt-30 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li class="active">{!! $item->name !!}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-wraper">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 order-1 order-lg-2 pb-30">
          <div class="shoptopbar-heading">
            <h2>{{ $item->name }}</h2>
          </div>
          <div class="shop-top-bar mt-25">
            <div class="shop-bar-inner">
              <div class="toolbar-amount m-0">
                <span>There are {{ $products->count() }} products.</span>
              </div>
            </div>
          </div>
          @if ($products->count() > 0)
          <div class="shop-products-wrapper bg-white mt-30 pb-60 pb-sm-30">
            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
              <div class="fb-product_wrap shop-product-area">
                <div class="row">
                  @foreach ($products as $product)
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('product.details',$product->id) }}">
                          <img class="primary-img" src="{{ asset('storage/' . ($product->image ? $product->image : 'images/default.png')) }}">
                        </a>
                        @if (Illuminate\Support\Carbon::parse($product->created_at)->diffInDays(Illuminate\Support\Carbon::now()) < $days) <span class="sticker">New</span>
                          @endif
                          @if ($product->discount != null)
                          <span class="sticker-2">{{ $product->discount }}%</span>
                          @endif
                      </div>
                      <div class="product-content">
                        <h2 class="product-name">
                          <a href="{{ route('product.details',$product->id) }}">{{ $product->name }}</a>
                        </h2>
                        <div class="rating-box">
                          <ul class="rating">
                            @php
                            $avgRating = round($product->Reviews()->avg('rating'));
                            @endphp
                            <li class="{{ $avgRating >= 1 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                            <li class="{{ $avgRating >= 2 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                            <li class="{{ $avgRating >= 3 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                            <li class="{{ $avgRating >= 4 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                            <li class="{{ $avgRating >= 5 ? "":"no-star" }}"><i class="fa fa-star"></i></li>
                          </ul>
                        </div>
                        <div class="price-box">
                          <span class="new-price">&#2547;{{ $product->sell_price ?? $product->regular_price }}</span>
                          @if ($product->sell_price)
                          <span class="old-price">&#2547;{{ $product->regular_price }}</span>
                          @endif
                          @if (($product->stock - $product->stock_out) < 1) <small class="text-danger float-right">Out of stock</small>
                            @endif
                        </div>
                        <div class="product-action">
                          <ul class="product-action-link">
                            <li class="shopping-cart_link">
                              <a href="javascript:" class="plus-btn ppb{{ $product->id }} btn add-to-cart cartPlus cart{{ $product->id }}" data-id="{{ $product->id }}" title="Shopping Cart">
                                <i class="ion-bag"></i>
                              </a>
                            </li>
                            <input type="hidden" name="qty" class="qty{{ $product->id }}" data-qty=0>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            {{ $products->links() }}
          </div>
          @else
          <div class="shop-products-wrapper bg-white mt-30 pb-sm-30">
            <h2 class="p-4 text-center">No Product Found</h2>
          </div>
          @endif
        </div>
        <div class="col-lg-3 order-2 order-lg-1">
          <form action="{{ url()->current() }}" method="GET" id="sortForm">
            <div class="sidebar-title-2">
              <h2>Sort by</h2>
            </div>
            <div class="product-select-box mb-3">
              <div class="product-short">
                <select class="nice-select" name="sort" onchange="this.form.submit()">
                  <option value="">Select Option</option>
                  <option value="asc" {{ request()->has('sort') ? (request()->get('sort') == 'asc' ? 'selected' : null) : null }}>
                    Price (Low &gt; High)
                  </option>
                  <option value="desc" {{ request()->has('sort') ? (request()->get('sort') == 'desc' ? 'selected' : null) : null }}>
                    Price (High &gt; Low)
                  </option>
                  <option value="latest" {{ request()->has('sort') ? (request()->get('sort') == 'latest' ? 'selected' : null) : null }}>
                    New Released
                  </option>
                </select>
              </div>
            </div>
            @if($item->type == 'category' && \App\Model\Subcategory::where('category_id', $item->id)->count() > 0)
            <div class="sidebar-title-2">
              <h2>Sub Categories</h2>
            </div>
            <div class="sidebar-categores-box sidebar-categores_list mt-sm-25 mt-xs-25" style="max-height: 400px; overflow-x: auto">
              <div class="sidebar-categores-checkbox">
                <ul>
                  @foreach (\App\Model\Subcategory::where('category_id', $item->id)->get() as $key => $subcategory)
                  <li>
                    <input type="checkbox" {{ $subcategory_id ? (collect($subcategory_id)->contains($subcategory->id) ? 'checked' : '') : null }} name="subcategories[]" value="{{ $subcategory->id }}"
                      id="subcategory{{ $subcategory->id }}" onChange="this.form.submit()">
                    <label class="mb-0 text-sm" for="subcategory{{ $subcategory->id }}">{{ Str::limit($subcategory->name, 18, '...') }}
                      @php
                      $count = 0;
                      foreach ($subcategory->products as $product) {
                      if($item->Products->contains($product->id))
                      {
                      $count++;
                      }

                      }
                      @endphp
                      ({{ $count }})
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @endif
            @if($item->type != 'category')
            <div class="sidebar-title-2">
              <h2>Categories</h2>
            </div>
            <div class="sidebar-categores-box sidebar-categores_list mt-sm-25 mt-xs-25" style="max-height: 400px; overflow-x: auto">
              <div class="sidebar-categores-checkbox">
                <ul>
                  @foreach ($categories as $key => $category)
                  <li>
                    <input type="checkbox" {{ $category_id ? (collect($category_id)->contains($category->id) ? 'checked' : '') : null }} name="categories[]" value="{{ $category->id }}"
                      id="category{{ $category->id }}" onChange="this.form.submit()">
                    <label class="mb-0 text-sm" for="category{{ $category->id }}">{{ Str::limit($category->name, 18, '...') }}
                      @php
                      if($item->type){
                      $products = App\Model\Product::where('category_id',$category->id)->where($item->type . '_id',$item->id)->get();
                      }else{
                      $products = App\Model\Product::where('category_id',$category->id)->where('subject_id',$item->id)->get();
                      }
                      @endphp
                      {{-- ({{ $products->count() }}) --}}
                      @php
                      $products = $category->Products->where($item->name.'_id',$item->id)->count();

                      @endphp
                      ({{ $products }})
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @endif
            {{-- <div class="sidebar-title-2">
              <h2>Languages</h2>
            </div>
            <div class="sidebar-categores-box sidebar-categores_list mt-sm-25 mt-xs-25">
              <div class="sidebar-categores-checkbox">
                <ul>
                  @foreach ($languages as $language)
                  <li>
                    <input type="checkbox" {{ $language_id ? (collect($language_id)->contains($language->id) ? 'checked' : '') : null }} name="languages[]" value="{{ $language->id }}"
                      id="language{{ $language->id }}" onChange="this.form.submit()">
                    <label for="language{{ $language->id }}">{{ $language->name }}</label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div> --}}
            <div class="sidebar-title-2">
              <h2>Price</h2>
            </div>
            <div class="sidebar-categores-box sidebar-categores_list mt-sm-25 mt-xs-25">
              <div class="sidebar-categores-checkbox">
                <p>
                  <label for="amount">Price range:</label>
                  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold; max-width:100%" name="price" onChange="this.form.submit()">
                </p>
                <div id="slider-range"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script>
  $(function () {
      let sliderRange = $("#slider-range");
      sliderRange.slider({
        range: true,
        min: {{ minPrice() }},
        max: {{ maxPrice() }},
        values: [ {{ $newMinPrice }}, {{ $newMaxPrice }} ],
        slide: function (event, ui) {
          $("#amount").val("৳" + ui.values[0] + "- ৳" + ui.values[1]);
          setTimeout(function () {
            $('#sortForm').submit();
          }, 1500)
        }
      });
      $("#amount").val("৳" + sliderRange.slider("values", 0) + " - ৳" + sliderRange.slider("values", 1));
    });
</script>
@endpush
