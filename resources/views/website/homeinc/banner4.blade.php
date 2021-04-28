@if(isset($banner->banner4))
<div class="fb-banner_wrap">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Banner Area -->
      <div class="col-lg-12">
        <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30">
          <a href="{{ $banner->banner4_url ? $banner->banner4_url : '#' }}">
            <img src="{{ asset('storage/' . $banner->banner4) }}" alt="FB'S Banner" class="img-fluid">
          </a>
        </div>
      </div>
      <!-- FB's Banner Area End Here -->
    </div>
  </div>
</div>
@endif
