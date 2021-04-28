@extends('website.layouts.website')
@section('content')
<!-- Begin Body Wraper Area -->
<div class="body-wrapper">
  <!-- Begin Header Area -->

  <!-- Header Area End Here -->
  <!-- Begin FB's Breadcrumb Area -->
  <div class="breadcrumb-area pt-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li class="active">Blog</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FB's Breadcrumb Area End Here -->
  <!-- Begin Li's Main Blog Page Area -->
  <div class="fb-main-blog-page pt-60 pb-40 pb-sm-15 pb-xs-15">
    <div class="container">
      <div class="row">
        <!-- Begin Li's Blog Sidebar Area -->
        <div class="col-lg-3 order-lg-2 order-2">
          <div class="fb-blog-sidebar-wrapper">
            <div class="fb-blog-sidebar">
              <div class="fb-sidebar-search-form">
                <form action="#">
                  <input type="text" class="fb-search-field" placeholder="search here">
                  <button type="submit" class="fb-search-btn"><i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
            <div class="fb-blog-sidebar pt-25">
              <h4 class="fb-blog-sidebar-title">Categories</h4>
              <ul class="fb-blog-archive">
                @foreach ($categories as $item)
                <li><a href="{{ route('post.by_category', $item->id) }}">{{ $item->name }} ({{ $item->Posts->count() }})</a></li>
                @endforeach
              </ul>
            </div>
            <div class="fb-blog-sidebar">
              <h4 class="fb-blog-sidebar-title">Recent Post</h4>
              @foreach ($posts->take(5) as $post)
              <div class="fb-recent-post pb-30">
                <div class="fb-recent-post-thumb">
                  <a href="{{ route('post.view', $post->id) }}">
                    <img class="img-full" src="{{ asset('storage/' . ($post->image ? $post->image : 'images/default.png')) }}" alt="post Image">
                  </a>
                </div>
                <div class="fb-recent-post-des">
                  <span><a href="{{ route('post.view', $post->id) }}">{{ Illuminate\Support\Str::limit($post->name, 20, '...') }}</a></span>
                  <span class="fb-post-date">{{ $post->created_at->diffForHumans() }}</span>
                </div>
              </div>
              @endforeach
            </div>
            <div class="fb-blog-sidebar">
              <h4 class="fb-blog-sidebar-title">Tags</h4>
              <ul class="fb-blog-tags pt-10">
                @foreach ($tags as $item)
                <li><a href="{{ route('post.by_tag', $item->id) }}">{{ $item->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!-- Li's Blog Sidebar Area End Here -->
        <!-- Begin Li's Main Content Area -->
        <div class="col-lg-9 order-lg-1 order-1">
          <div class="row fb-main-content">
            @forelse ($posts as $post)
            <div class="col-lg-6 col-md-6">
              <div class="fb-blog-single-item pb-20">
                <div class="fb-blog-banner">
                  <a href="{{ route('post.view', $post->id) }}"><img class="img-full" style="height:250px; width: 100%; object-fit: cover; object-position: center"
                      src="{{ asset('storage/' . ($post->image ? $post->image : 'images/default.png')) }}" alt=""></a>
                </div>
                <div class="fb-blog-content">
                  <div class="fb-blog-details">
                    <h3 class="fb-blog-heading pt-25"><a href="{{ route('post.view', $post->id) }}">{{ $post->name }}</a></h3>
                    <div class="fb-blog-meta">
                      <a class="post-time" href="javascript:"><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</a>
                    </div>
                    <p>{!! Illuminate\Support\Str::limit($post->details, 100, '...') !!}</p>
                    <a class="read-more" href="{{ route('post.show', $post->id) }}">Read More...</a>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <p>No post to show.</p>
            @endforelse
          </div>
          {{ $posts->links() }}
        </div>
        <!-- Li's Main Content Area End Here -->
      </div>
    </div>
  </div>
</div>
@endsection
