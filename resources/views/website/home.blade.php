@php
$days = 7;
@endphp

@extends('website.layouts.website')
@section('content')

<section>
  @include('website.homeinc.bannerSection')
</section>

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

@endsection
