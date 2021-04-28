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
            Post Categories
          </h3>
        </div>
      </div>
      <div class="kt-portlet__body">
        <!--begin: Search Form -->
        <div class="kt-form kt-form--label-right">
          <div class="row align-items-center">
            <div class="col-xl-8 order-2 order-xl-1">
            </div>
            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
              <div class="kt-input-icon kt-input-icon--left">
                <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                <span><i class="la la-search"></i></span>
              </span>
              </div>
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
            <th>Name</th>
            <th>Action</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <!-- start -->
          @php ($i = 1)
          @foreach($categories as $category)
            <tr>
              <td>
                {{ $i++ }}
              </td>
              <td>
                {{$category->name}}
              </td>
              <td>
                <form method="post" action="{{ route('post_category.destroy',$category->id) }}">
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
