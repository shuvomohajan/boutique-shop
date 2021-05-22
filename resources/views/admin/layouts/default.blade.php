<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8"/>

  <title>{{ $companyInfo->name }}</title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  {{-- <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjLogos/latest/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> --}}

  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

</head>
<!-- Change: delete body class=" kt-header--fixed kt-header-mobile--fixed " -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed" style="background-color: #f2f3f8;">
  <div class="kt-header-mobile__logo">
    <a href="/">
      <img alt="{{ $companyInfo->name }}" src="{{ asset('storage/' . $companyInfo->logo) }}" style="height: 30px; width: auto"/>
    </a>
  </div>
  <div class="kt-header-mobile__toolbar">
    <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

    {{-- <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button> --}}

    {{-- <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button> --}}
  </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    <!-- side bar -->
    @include('admin.layouts.includes.sidebar')

    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper">
      <!-- Nav bar -->
      @include('admin.layouts.includes.navbar')
      <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- Sub header -->
      @include('admin.layouts.includes.subHeader')
      <!-- content -->
        @yield('content')
      </div>
    </div>
  </div>
</div>
@include('admin.layouts.includes.quickPanel')
<div id="kt_scrolltop" class="kt-scrolltop">
  <i class="fa fa-arrow-up"></i>
</div>

<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/crud/metronic-datatable/base/html-table.js')}}" type="text/javascript"></script>

@stack('script')

<script>
  $(function () {
    $('.select2').select2({
      placeholder: 'Select option',
    });
    $('.select2-withTag').select2({
      placeholder: 'Select option',
      tags: "true",
    });
    $('.datetimepicker').daterangepicker({
      timePicker: true,
      singleDatePicker: true,
      locale: {
        format: 'YYYY/M/DD HH:mm:ss'
      }
    });
    $('.alert').delay(3000).slideUp();
  });
</script>

</body>

</html>
