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
              <li><a href="{{ route('allPost.index') }}">Blog</a></li>
              <li class="active">{{ $post->name }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FB's Breadcrumb Area End Here -->
  <!-- Begin FB's Main Blog Page Area -->
  <div class="fb-main-blog-page fb-main-blog-details-page pt-60 pb-30 pb-sm-45 pb-xs-45">
    <div class="container">
      <div class="row">
        <!-- Begin FB's Blog Sidebar Area -->
        <div class="col-lg-3 order-lg-2 order-2">
          <div class="fb-blog-sidebar-wrapper">
            <div class="fb-blog-sidebar">
              <h4 class="fb-blog-sidebar-title">Recent Post</h4>
              @foreach ($posts->except($post->id) as $post)
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
          </div>
        </div>
        <!-- FB's Blog Sidebar Area End Here -->
        <!-- Begin FB's Main Content Area -->
        <div class="col-lg-9 order-lg-1 order-1">
          <div class="row fb-main-content">
            <div class="col-lg-12">
              <div class="fb-blog-single-item pb-30">
                <div class="fb-blog-banner">
                  <a href="#"><img class="img-full" src="{{ asset('storage/' . ($post->image ? $post->image : 'images/default.png')) }}" alt=""></a>
                </div>
                <div class="fb-blog-content">
                  <div class="fb-blog-details">
                    <h3 class="fb-blog-heading pt-25">{{ $post->name }}</h3>
                    <div class="fb-blog-meta">
                      <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</a>
                    </div>
                    <p>{!! $post->details !!}</p>
                    <div class="fb-tag-line">
                      <h4>tag:</h4>
                      @foreach ($post->BlogTags as $tag)
                      <a href="{{ route('post.by_tag', $tag->id) }}" style="border: 1px solid lightgray" class="px-2">{{ $tag->name }}</a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- FB's Main Content Area End Here -->
      </div>
    </div>
  </div>
</div>
<!-- Body Wraper Area End Here -->
<!-- JS
============================================ -->
<!-- jQuery JS -->
@endsection
