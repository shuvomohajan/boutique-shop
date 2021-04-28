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
                            <li class="active">Refund</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="frequently-area pb-15">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="frequently-content">
                        <div class="frequently-desc">
                          <h3>Lorem ipsum dolor sit amet.</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec id erat sagittis, faucibus metus malesuada, eleifend turpis. Mauris semper augue id nisl aliquet, a porta lectus mattis. Nulla at tortor augue. In eget enim diam. Donec gravida tortor sem, ac fermentum nibh rutrum sit amet. Nulla convallis mauris vitae congue consequat. Donec interdum nunc purus, vitae vulputate arcu fringilla quis. Vivamus iaculis euismod dui.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
