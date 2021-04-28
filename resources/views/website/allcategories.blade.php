@extends('website.layouts.website')
@section('content')
  <div class="body-wrapper">
    <!-- Begin Header Area -->
    <!-- Header Area End Here -->
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area pt-30 pb-30">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-content">
              <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">All Categories</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-wraper">
      <div class="container">
        <div class="row">
          @foreach ($items->chunk(8) as $itemCollection)
            <div class="col-4">
              <div class="list-group mb-2">
                @foreach ($itemCollection as $item)
                  <a href="{{ route('all.products', [$type, $item->id]) }}" class="list-group-item list-group-item-action">
                    @if ($item->icon == null)
                      <img src="{{ asset('default-subject.png') }}" alt="" width="25">
                    @else
                      <img src="{{ asset($item->icon) }}" alt="" width="25">
                    @endif
                    {{ $item->name }}
                  </a>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

