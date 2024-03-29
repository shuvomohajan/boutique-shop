@extends('admin.layouts.default')
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet kt-portlet--mobile">
    @if(session()->has('Smsg'))
    <div class="alert alert-success">
      {{session()->get('Smsg')}}
    </div>
    @elseif(session()->has('Fmsg'))
    <div class="alert alert-danger">
      {{session()->get('Fmsg')}}
    </div>
    @endif
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <span class="kt-widget__icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                <path
                  d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                  fill="#000000" opacity="0.3" />
              </g>
            </svg>
          </span>
        </span>
        <h3 class="kt-portlet__head-title">
          Sliders
          <!-- <small>Datatable initialized from HTML table</small> -->
        </h3>
      </div>
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <a href="{{route('slider.create')}}" class="btn btn-default btn-icon-sm">
              <i class="la la-plus"></i>
              Add New
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">
      <!--begin: Search Form -->
      <div class="kt-form kt-form--label-right">
        <div class="row align-items-center">
          <div class="col-xl-8 order-2 order-xl-1">
            <!-- <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                            </div>
                        </div> -->
          </div>
          <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
            <div class="kt-input-icon kt-input-icon--left">
              <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
              <span class="kt-input-icon__icon kt-input-icon__icon--left">
                <span><i class="la la-search"></i></span>
              </span>
            </div>
            <!-- <a href="#" class="btn btn-default ">
                            <i class="la la-cart-plus"></i> New Order
                        </a> -->
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
          </div>
        </div>
      </div>
      <!--end: Search Form -->
    </div>
    <div class="kt-portlet__body kt-portlet__body--fit" style="margin-top: -20px;">
      <!--begin: Datatable -->
      <table class="kt-datatable" id="html_table" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Title Mini</th>
            <th>Button</th>
            <th>Link</th>
            <th>Active Status</th>
            <th>Action</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- start -->
          @php ($i = 1)
          @foreach($sliders as $slider)
          <tr>
            <td>
              {{ $i++ }}
            </td>
            <td>
              <img src="{{ !is_null($slider->image) ? asset('storage/'.$slider->image) : asset('storage/images/default.png') }}" alt="avater" height="60px" width="60px" />
            </td>
            <td>
              {{$slider->title}}
            </td>
            <td>
              {{$slider->title_mini}}
            </td>
            <td>
              {{$slider->button_name}}
            </td>
            <td>
              {{$slider->button_link}}
            </td>
            <td>
              {{$slider->status ? 'active' : 'Inactive'}}
            </td>
            <td>
              <form method="post" action="{{ route('slider.destroy',$slider->id) }}">
                <a href="{{ route('slider.edit', $slider->id) }}" class="btn-label-brand btn btn-sm btn-bold">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn-sm btn btn-danger">Delete</button>
              </form>
            </td>
            <td></td>
          </tr>
          @endforeach

          <!-- End -->
        </tbody>
      </table>
      <!--end: Datatable -->
    </div>
  </div>
</div>
<!-- end:: Content -->
@endsection
