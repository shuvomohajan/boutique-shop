@php
$days = 7;
@endphp

@extends('website.layouts.website')
@section('content')

<section>
  @include('website.homeinc.bannerSection')
</section>

<div class="fb-customer_support pb-40">
  <div class="container">
    <div class="row fb-customer_support-nav bg-white ml-0 mr-0 mt-30">
      <div class="col-lg-4 col-md-4">
        <ul class="customer-support_info pt-xs-30">
          <li class="customer-support_text customer-support_text-3">
            <i class="fa fa-clock-o"></i>
            <span class="customer-support_date">১২/৭</span>
            <span class="customer-support_service">সাপোর্ট!</span>
          </li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-4">
        <ul class="customer-support_info pt-xs-30">
          @if(isset($companyInfo->mobile1))
          <li class="customer-support_text customer-support_text-3">
            <i class="fa fa-phone"></i>
            <span class="customer-support_date">{{ $companyInfo->mobile1 }}</span>
            <span class="customer-support_service">ফ্রী সাপোর্ট লাইন!</span>
          </li>
          @endif
        </ul>
      </div>
      <div class="col-lg-4 col-md-4">
        <ul class="customer-support_info customer-support_info-3 pt-xs-30 pb-xs-30">
          @if(isset($companyInfo->email))
          <li class="customer-support_text customer-support_text-3">
            <i class="fa fa-cog"></i>
            <span class="customer-support_date">{{ $companyInfo->email }}</span>
            <span class="customer-support_service">অর্ডার সাপোর্ট!</span>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>

<section>
  @include('website.homeinc.featureproduct')
</section>

<section>
  @include('website.homeinc.banner1')
</section>

<section id = 'cat_section1'>
  @include('website.homeinc.categoryproduct')
</section>

<section id = 'cat_section2'>
  @include('website.homeinc.categoryproduct2')
</section>

<section>
  @include('website.homeinc.banner2&3')
</section>

<section id = 'cat_section3'>
  @include('website.homeinc.categoryproduct3')
</section>

<section id = 'cat_section4'>
  @include('website.homeinc.categoryproduct4')
</section>

<section>
  @include('website.homeinc.banner4')
</section>

<section id = "cat_section567">
  @include('website.homeinc.categoryproductthen')
</section

@if(isset($banner->banner5) || isset($banner->banner6))
<div class="fb-banner_wrap">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Banner Area -->
      @if(isset($banner->banner5))
      <div class="col-lg-6">
        <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30">
          <a href="{{ $banner->banner5_url ? $banner->banner5_url : '#' }}">
            <img src="{{ asset('storage/' . $banner->banner5) }}" alt="">
          </a>
        </div>
      </div>
      @endif
      <!-- FB's Banner Area End Here -->
      <!-- Begin FB's Banner Area -->
      @if(isset($banner->banner6))
      <div class="col-lg-6">
        <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30">
          <a href="{{ $banner->banner6_url ? $banner->banner6_url : '#' }}">
            <img src="{{ asset('storage/' . $banner->banner6) }}" alt="">
          </a>
        </div>
      </div>
      @endif
      <!-- FB's Banner Area End Here -->
    </div>
  </div>
</div>
@endif

<section>
  @include('website.homeinc.bottomsection')
</section>

@endsection
