@if(isset($banner->banner2) || isset($banner->banner3))
<div class="fb-banner_wrap">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Banner Area -->
      @if(isset($banner->banner2))
      <div class="col-lg-6">
        <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30">
          <a href="{{ $banner->banner2_url ? $banner->banner2_url : '#' }}">
            <img src="{{ asset('storage/' . $banner->banner2) }}" alt="FB'S Banner">
          </a>
        </div>
      </div>
      @endif
      <!-- FB's Banner Area End Here -->
      <!-- Begin FB's Banner Area -->
      @if(isset($banner->banner3))
      <div class="col-lg-6">
        <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30">
          <a href="{{ $banner->banner3_url ? $banner->banner3_url : '#' }}">
            <img src="{{ asset('storage/' . $banner->banner3) }}" alt="FB'S Banner">
          </a>
        </div>
      </div>
      @endif
      <!-- FB's Banner Area End Here -->
    </div>
  </div>
</div>
@endif
