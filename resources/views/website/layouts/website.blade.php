<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $companyInfo->name }}</title>

  <link rel="stylesheet" href="{{ asset('css/visitor.css') }}">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
    .order-button-payment .disabled{
      color: gray !important;
      background-color: rgb(90, 90, 90) !important;
      cursor: not-allowed !important;
    }
  </style>
</head>

<body>
<header class="header-3 bg-midnight">
  <!-- Begin Header Top Area -->
  <div class="header-top">
    <div class="container">
      <div class="header-top-nav">
        <div class="row">
          <!-- Begin FB's Contact Information Area -->
          <div class="col-lg-5">
            <div class="fb-contact-info pt-sm-10 pt-xs-10 pb-sm-10 pb-xs-10">
              <ul>
                @if(isset($companyInfo->mobile1))
                  <li class="phone"><span>মোবাইল: </span><a href="callto://+123123321345">{{ $companyInfo->mobile1 }} {{ $companyInfo->mobile2 ? ', ' . $companyInfo->mobile2 : null }}</a></li>
                @endif
                @if(isset($companyInfo->email))
                  <li class="email"><span>ই-মেইল: </span><a href="mailto://info@yourdomain.com">{{ $companyInfo->email }}</a></li>
                @endif
              </ul>
            </div>
          </div>
          <!-- FB's Contact Information Area End Here -->
          <!-- Begin Header Top Left Area Area -->
          <div class="col-lg-7">
            <div class="top-selector-wrapper pb-sm-10 pb-xs-10">
              <ul class="single-top-selector">
                <!-- Begin My Account Area -->
                <li class="language my-account list-inline-item">
                  <div class="btn-group">
                    <button class="dropdown-toggle">অ্যাকাউন্ট<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-menu">
                      <ul>
                        @guest
                          <li>
                            <a href="{{ route('login') }}">{{ __('লগিন') }}</a>
                          </li>
                          @if (Route::has('register'))
                            <li>
                              <a href="{{ route('register') }}">{{ __('রেজিস্ট্রেশন') }}</a>
                            </li>
                          @endif
                        @else
                          <li>
                            <a href="{{ route('dashboard') }}">{{ __('অ্যাকাউন্ট') }}</a>
                          </li>
                          <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              {{ __('লগআ উট') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
                          </li>
                        @endguest
                      </ul>
                    </div>
                  </div>
                </li>
                <!-- My Account Area End Here -->
                <!-- Begin Currency Area -->
                {{--<li class="currency list-inline-item">
                  <span>কারেন্সি:</span>
                  <div class="btn-group">
                    <button class="dropdown-toggle"> কারেন্সি $ <i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-menu">
                      <ul>
                        <li><a href="#">Euro €</a></li>
                        <li><a href="#" class="current">USD $</a></li>
                      </ul>
                    </div>
                  </div>
                </li>--}}
                <li class="language last-child list-inline-item">
                  <span>কারেন্সি ৳</span>
                </li>
              {{--<li class="language last-child list-inline-item">
                <span>উইশলিস্ট</span>
              </li>--}}
              <!-- Currency Area End Here -->
                <!-- Begin Language Area -->
              {{-- <li class="language last-child list-inline-item">
                <span>ভাষা</span>
                <div class="btn-group">
                  <button class="dropdown-toggle"><img src="{{asset('assets/frontend/Images/menu/flag-icon/1.jpg')}}" alt="">English<i class="fa fa-caret-down"></i></button>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="#"><img src="{{asset('assets/frontend/Images/menu/flag-icon/1.jpg')}}" alt=""> English</a></li>
                  <li><a href="#"><img src="{{asset('assets/frontend/Images/menu/flag-icon/2.jpg')}}" alt=""> Français</a></li>
                </ul>
              </div>
          </div>
          </li> --}}



              <!-- Language End Here -->
              </ul>
            </div>
          </div>
          <!-- Header Top Left Area End Here -->
        </div>
      </div>
    </div>
  </div>
  <!-- Header Top Area End Here -->
  <!-- Begin Header Middle Area -->
  <div class="header-middle">
    <div class="container logo-nav">
      <div class="row align-items-center">
        <!-- Begin Logo Area -->
        <div class="col-lg-3">
          <div class="logo">
            <a href="{{ url('/') }}">
              @if(isset($companyInfo->logo))
              <img src="{{asset('storage/' . $companyInfo->logo )}}" alt="BoiOnlineBD">
              @else
              <img src="" alt="BoiOnlineBD">
              @endif
            </a>
          </div>
        </div>
        <!-- Logo Area End Here -->
        <!-- Begin Header Middle Right Area -->
        <div class="col-lg-9">
          <!-- Begin Header Middle Right Area -->
          <div class="header-middle-right">
            <!-- Begin Header Middle Searchbox Area -->
            <form action="{{ route('mySearch') }}" class="hm-searchbox" method="POST">
              @csrf
              <input type="hidden" name="hidden" value="1">
              <select autocomplete="off" class="nice-select select-search-category" id="categorySearch" name="category_id">

                <option value="">বিষয়</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endForeach
              </select>
              <input type="text" class="mySearch" placeholder="এখানে লিখুন ..." id="searchKey" name="search" autocomplete="off">
              <button class="fb-search_btn" type="submit"><i class="fa fa-search"></i></button>
              <div id="searchReasults" class="border position-absolute bg-white d-none"></div>
            </form>
            <!-- Header Middle Searchbox Area End Here -->
            <ul class="hm-menu midnav-cart">
              <!-- Begin Header Mini Cart Area -->
              <li class="hm-minicart">
                <div class="hm-minicart-trigger">
                  <span class="item-icon"></span>
                  <span class="item-text">কার্ট

                      <span class="cart-item-count total-item">0</span>
                    </span>
                  <span class="item-total total-cart">0</span>
                </div>
                <span></span>
                <div class="minicart">
                  <ul class="minicart-product-list show-cart">
                  </ul>
                  <div class="price-content">
                    <p class="minicart-total">Total<span class=""> &#2547;<span class="total-cart">0</span></span></p>
                  </div>
                  <div class="minicart-button text-center">
                    <a href="{{ url('cart') }}" class="fb-btn">
                      <span>Show Cart</span>
                    </a>
                  </div>
                </div>
              </li>
              <!-- Header Mini Cart Area End Here -->
            </ul>
          </div>
          <!-- Header Middle Right Area End Here -->
        </div>
        <!-- Header Middle Right Area End Here -->
      </div>
    </div>
  </div>
  <!-- Header Middle Area End Here -->
  <!-- Begin Header Bottom Area -->
  <div class="header-bottom bg-dark-grayishblue header-sticky stick">
    <div class="container">
      <div class="row">
        <!-- Begin Header Bottom Menu Area -->
        <div class="col-lg-10 d-none d-lg-block d-xl-block">
          <!-- FB's Navigation -->
          <nav class="fb-navigation">
            <ul>
              <li class="active">
                <a href="{{ url('/') }}">প্রচ্ছদ</a>
              </li>
              <li class="megamenu-holder">
                <a href="#">প্রকাশক</a>
                <ul class="megamenu">
                  @foreach ($publishers->chunk(8) as $publishersChunk)
                    <li>
                      @foreach ($publishersChunk as $publisher)
                        <ul>
                          <li><a href="{{ route('all.products', ['publisher', $publisher->id]) }}">{{ $publisher->name }}</a></li>
                        </ul>
                      @endforeach
                    </li>
                  @endforeach
                </ul>
              </li>

              <li class="megamenu-holder">
                <a href="#">লেখক</a>
                <ul class="megamenu">
                  @foreach ($authors->take(39)->chunk(8) as $authorsChunk)
                    @php
                      $lastItem = $loop->last ? true : false;
                    @endphp
                    <li>
                      @foreach ($authorsChunk as $author)
                        <ul>
                          @if ($lastItem && $loop->last)
                            <li><a href="{{ route('all.products', ['author', $author->id]) }}">{{ $author->name }}</a></li>
                            @if (count($authors)>40)
                              <li><a href="{{ route('author.all') }}" class="btn btn-outline-dark"> See more </a></li>
                            @endif

                            {{-- <li><a href="{{ route('all.products', ['author', $author->id]) }}">{{ $author->name }}</a></li> --}}
                          @else
                            {{-- <li><a href="{{ route('all.products', ['subject', $subject->id]) }}">{{ $subject->name }}</a>
                        </li> --}}
                            <li><a href="{{ route('all.products', ['author', $author->id]) }}">{{ $author->name }}</a></li>
                          @endif
                        </ul>
                      @endforeach
                    </li>
                  @endforeach
                </ul>
              </li>


              <li class="megamenu-holder">
                <a href="#">বিষয়</a>
                <ul class="megamenu">
                  @foreach ($categories->take(39)->chunk(8) as $categoriesChunk)
                    @php
                      $lastItem = $loop->last ? true : false;
                    @endphp
                    <li>
                      @foreach ($categoriesChunk as $category)
                        <ul>
                          @if ($lastItem && $loop->last)
                            {{-- <li><a href="{{ route('subject.all') }}" class="btn btn-outline-dark"> See more </a></li> --}}
                            <li><a href="{{ route('all.products', ['category', $category->id]) }}">{{ $category->name }}</a></li>
                            @if (count($categories)>40)
                              <li><a href="{{ route('category.all') }}" class="btn btn-outline-dark"> See more </a></li>
                            @endif
                          @else
                            <li><a href="{{ route('all.products', ['category', $category->id]) }}">{{ $category->name }}</a></li>
                          @endif
                        </ul>

                      @endforeach
                    </li>
                  @endforeach
                </ul>
              </li>

              {{-- <li class="dropdown-holder">
                  <a href="shop-left-sidebar.html">প্যাকছ</a>
                  <ul class="hb-dropdown">
                    <li><a href="shop-left-sidebar.html">Shop Layouts</a>
                      <ul>
                        <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                        <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                        <li><a href="shop-3-column.html">Shop 3 Column</a></li>
                        <li><a href="shop-4-column.html">Shop 4 Column</a></li>
                        <li><a href="shop-list-left-sidebar.html">Shop List</a></li>
                        <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                        <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                      </ul>
                    </li>
                    <li><a href="product-details.html">Product Details</a>
                      <ul>
                        <li><a href="product-details.html">Product Details</a></li>
                      </ul>
                    </li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="wishlist.html">Wishlist</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li><a href="compare.html">Compare</a></li>
                  </ul>
                </li> --}}

              {{--<li class="dropdown-holder">
                <a href="">সংবাদ</a>
                <ul class="hb-dropdown">
                  <li><a href="blog-left-sidebar.html">A</a></li>
                  <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                  <li><a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a></li>
                  <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                  <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                  <li><a href="blog-details-right-sidebar.html">Blog Details Right Sidebar</a></li>
                  <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                  <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                  <li><a href="blog-video-format.html">Blog Video Format</a></li>
                </ul>
              </li>--}}
              <li>
                <a href="{{ route('allPost.index') }}">সংবাদ</a>
              </li>
              <li>
                <a href="{{url()->to('about-us')}}">কোম্পানি</a>
              </li>
              <li>
                <a href="{{url()->to('products/category/20')}}">প্যাকেজ</a>
              </li>
              <li>
                <a href="{{url()->to('products/category/21')}}">বই ব্যাংক</a>
              </li>
              <li>
                <a href="{{ url('customer_support') }}">যোগাযোগ</a>
              </li>
            </ul>
          </nav>
          <!--FB's Navigation -->
        </div>
        <div class="col-lg-2 d-none d-lg-block d-xl-block">
          <ul class="hm-menu bottomnav-cart" style="display: none">
            <!-- Begin Header Mini Cart Area -->
            <li class="hm-minicart">
              <div class="hm-minicart-trigger">
                <span class="item-icon"></span>
                <span class="item-text">কার্ট

                      <span class="cart-item-count total-item">0</span>
                    </span>
                <span class="item-total total-cart">$0.00</span>
              </div>
              <span></span>
              <div class="minicart">
                <ul class="minicart-product-list show-cart">
                </ul>
                <div class="price-content">
                  <p class="minicart-total">Total<span class=""> &#2547;<span class="total-cart">0.00</span></span></p>
                </div>
                <div class="minicart-button text-center">
                  <a href="{{ url('cart') }}" class="fb-btn">
                    <span>Show Cart</span>
                  </a>
                </div>
              </div>
            </li>
            <!-- Header Mini Cart Area End Here -->
          </ul>
        </div>

        <!-- Header Bottom Menu Area End Here -->
      </div>
      <div class="row">
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area mobile-menu-area-3 d-lg-none d-xl-none col-12">
          <div class="mobile-menu"></div>
        </div>
        <!-- Mobile Menu Area End Here -->
      </div>
    </div>
  </div>
  <!-- Header Bottom Area End Here -->
</header>


@yield('content')


{{------footer-----}}
<div class="fb-footer">
  <!-- Begin Footer Top Area -->
{{--<div class="fb-footer_top fb-footer_top-3">
  <div class="container">
    <div class="row">
      <!-- Begin FB's Newsletters Area -->
      <div class="col-lg-5">
        <div class="fb-newsletters">
          <h2 class="newsletters-headeing">Sign Up For Newsletters</h2>
          <p class="short-desc">Be The First To Know. Sign Up For Newsletter Today</p>
        </div>
      </div>
      <!-- FB's Newsletters Area End Here -->
      <!-- Begin FB's Newsletters Form Area -->
      <div class="col-lg-7">
        <div class="fb-newsletters_form fb-newsletters_form-3 pt-sm-15 pt-xs-15">
          <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form"
            name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
              <div id="mc-form" class="mc-form subscribe-form form-group">
                <input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email" />
                <button class="btn mt-sm-15 mt-xs-15" id="mc-submit">Subscribe!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- FB's Newsletters Form Area End Here -->
    </div>
  </div>
</div>--}}
<!-- Footer Top Area End Here -->
  <!-- Begin FB's Footer Middle Area -->
  <div class="fb-footer_middle bg-white">
    <div class="container">
      <!-- Begin Footer Middle Top Area -->
      <div class="footer-middle_top">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="fb-footer_widget fb-footer_widget-3 pt-20">
                  <h3 class="fb-footer-widget-headeing">Categories</h3>
                  <ul>
                    @foreach($categories->take(6) as $category)
                      <li><a href="{{ route('all.products', ['category', $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="fb-footer_widget fb-footer_widget-3 pt-20 pt-xs-0">
                  <h3 class="fb-footer-widget-headeing">Author</h3>
                  <ul>
                    @foreach($authors->take(6) as $author)
                      <li><a href="{{ route('all.products', ['author', $author->id]) }}">{{ $author->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="fb-footer_widget fb-footer_widget-3 pt-20 pt-xs-0">
                  <h3 class="fb-footer-widget-headeing">Publisher</h3>
                  <ul>
                    @foreach($publishers->take(6) as $publisher)
                      <li><a href="{{ route('all.products', ['publisher', $publisher->id]) }}">{{ $publisher->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="fb-footer_widget fb-footer_widget-3 pt-20 pt-xs-0">
                  <h3 class="fb-footer-widget-headeing">Others</h3>
                  <ul>
                    <li><a href="{{ url('privacy_policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                    <li><a href="{{ url('refund') }}">Refund</a></li>
                    <li><a href="{{ url('return') }}">Return</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="footer-widget-logo pt-30 mb-20 pt-sm-5 pt-xs-5">
              <a href="index.html">
                <img src="{{asset('storage/' . $companyInfo->footer_logo )}}" alt="BoiOnlineBD">
              </a>
            </div>
            <div class="footer-widget-info">
              <p class="footer-widget_short-desc">{{ $companyInfo->about_footer }}</p>
              <div class="footer-widget-social-link footer-widget-social-link-3">
                <ul class="social-link">
                  @if(isset($companyInfo->facebook))
                    <li class="facebook">
                      <a href="{{ $companyInfo->facebook }}" data-toggle="tooltip" target="_blank" title="Facebook">
                        <i class="fa fa-facebook"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset($companyInfo->twitter))
                    <li class="twitter">
                      <a href="{{ $companyInfo->twitter }}" data-toggle="tooltip" target="_blank" title="Twitter">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset($companyInfo->whatsapp))
                    <li class="youtube">
                      <a href="{{ $companyInfo->whatsapp }}" data-toggle="tooltip" target="_blank" title="Youtube">
                        <i class="fa fa-whatsapp"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset($companyInfo->instagram))
                    <li class="instagram">
                      <a href="{{ $companyInfo->instagram }}" data-toggle="tooltip" target="_blank" title="Instagram">
                        <i class="fa fa-instagram"></i>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <!-- FB's Footer Widget Area End Here -->
        </div>
      </div>
      <!-- Footer Middle Top Area End Here -->
      <!-- Begin Footer Middle Bottom Area -->
      <div class="footer-middle-bottom">
        <div class="row">
          <div class="col-lg-12">
            <!-- Begin Footer Tag Link Area -->
          {{--<div class="footer-tag-links footer-tag-links-3 pt-20 pb-20">
            <ul>
              <li><a href="#">Online Shopping</a></li>
              <li><a href="#">Promotions</a></li>
              <li><a href="#">My Orders</a></li>
              <li><a href="#">Help</a></li>
              <li><a href="#">Customer Service</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">Most Populars</a></li>
              <li><a href="#">New Arrivals</a></li>
              <li><a href="#">Special Products</a></li>
              <li><a href="#">Manufacturers</a></li>
              <li><a href="#">Our Stores</a></li>
              <li><a href="#">Shipping</a></li>
              <li><a href="#">Payments</a></li>
              <li><a href="#">Warantee</a></li>
              <li><a href="#">Refunds</a></li>
              <li><a href="#">Checkout</a></li>
              <li><a href="#">Discount</a></li>
              <li><a href="#">Terms & Conditions</a></li>
              <li><a href="#">Policy</a></li>
              <li><a href="#">Shipping</a></li>
              <li><a href="#">Payments</a></li>
              <li><a href="#">Returns</a></li>
              <li><a href="#">Refunds</a></li>
            </ul>
          </div>--}}
          <!-- Footer Tag Link Area End Here -->
            <!-- Begin Footer Payment Area -->
            <div class="payment text-center pb-30">
              <a href="#">
                <img src="{{asset('storage/images/payment.jpeg')}}" style="height: 100px" alt="FB's Footer Payment">
              </a>
            </div>
            <!-- Footer Payment Area End Here -->
          </div>
        </div>
      </div>
      <!-- Footer Middle Bottom Area End Here -->
    </div>
  </div>
  <!-- FB's Footer Middle Area End Here -->
  <!-- Begin Footer Bottom Area -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <!-- Begin Copyright Area -->
        <div class="col-lg-6 col-md-6">
          <div class="copyright copyright-3">
            <span>Copyright &copy; 2021 <a href="#">BoiOnlineBd.</a> All rights reserved.</span>
          </div>
        </div>
        <!-- Copyright Area End Here -->
        <!-- Begin Footer Bottom Menu Area -->
        <div class="col-lg-6 col-md-6">
          <div class="fotter-bottom_menu fotter-bottom_menu-3 text-right copyright copyright-3">
            <span>Developed By <a href="https://spinnertech.dev">Spinner Tech</a></span>
          </div>
        </div>
        <!-- Footer Bottom Menu Area End Here -->
      </div>
    </div>
  </div>
  <!-- Footer Bottom Area End Here -->
</div>
<!-- FB's Footer Area End Here -->
<!-- Begin Fb's Quick View | Modal Area -->
{{--<div class="modal fade modal-wrapper" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body pt-15 pb-30 pt-sm-10 pb-sm-30 pb-xs-50">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-inner-area row">
          <div class="col-lg-5 col-md-5 col-sm-5">
            <!-- Product Details Left -->
            <div class="product-details-left">
              <div class="product-details-images slider-navigation-1">
                <div class="lg-image">
                  <img src="{{asset('assets/frontend/Images/single-product/large-size/1.jpg')}}" alt="Single Product Image">
                </div>
                <div class="lg-image">
                  <img src="{{asset('assets/frontend/Images/single-product/large-size/2.jpg')}}" alt="Single Product Image">
                </div>
                <div class="lg-image">
                  <img src="{{asset('assets/frontend/Images/single-product/large-size/3.jpg')}}" alt="Single Product Image">
                </div>
                <div class="lg-image">
                  <img src="{{asset('assets/frontend/Images/single-product/large-size/4.jpg')}}" alt="Single Product Image">
                </div>
              </div>
              <div class="product-details-thumbs">
                <div class="sm-image"><img src="{{asset('assets/frontend/Images/single-product/small-size/1.jpg')}}" alt="Single Product Thumb">
                </div>
                <div class="sm-image"><img src="{{asset('assets/frontend/Images/single-product/small-size/2.jpg')}}" alt="Single Product Thumb">
                </div>
                <div class="sm-image"><img src="{{asset('assets/frontend/Images/single-product/small-size/3.jpg')}}" alt="Single Product Thumb">
                </div>
                <div class="sm-image"><img src="{{asset('assets/frontend/Images/single-product/small-size/4.jpg')}}" alt="Single Product Thumb">
                </div>
              </div>
            </div>
            <!--// Product Details Left -->
          </div>
          <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="product-details-view-content pt-40 pt-sm-25">
              <div class="product-info">
                <h2>Printed Dress</h2>
                <div class="price-box pb-20">
                  <span class="new-price new-price-2">$57.98</span>
                  <span class="old-price">$57.98</span>
                </div>
                <div class="sticker-2">Save 8%</div>
                <div class="product-desc">
                  <p>
                      <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom.
                      </span>
                  </p>
                </div>
                <div class="product-variants">
                  <div class="produt-variants-size">
                    <label>Dimension</label>
                    <select class="nice-select">
                      <option value="1" title="S" selected="selected">S</option>
                      <option value="2" title="M">M</option>
                      <option value="3" title="L">L</option>
                    </select>
                  </div>
                </div>
                <div class="single-add-to-cart">
                  <form action="#" class="cart-quantity">
                    <div class="quantity">
                      <label>Quantity</label>
                      <div class="cart-plus-minus">
                        <input class="cart-plus-minus-box" value="1" type="text">
                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                      </div>
                    </div>
                    <button class="fb-btn" type="submit">Add to cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>--}}

@if (session('message'))
  <div class="alert alert-dismissible fade show bg-white" style="position: fixed; top: 20px; right: 20px; z-index: 1000; max-width: 400px;">
    <div class="alert-heading">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="alert-body">
      {{ session('message') }}
    </div>
  </div>
@endif


<script src="{{ asset('js/visitor.js') }}"></script>
@stack('scripts')
<script>
  $(document).ready(function () {
    $('.quick-view-btn').hide();
    $('.single-product_link').hide();
    sessionStorage.clear();
    carts();
    /*logincheck();
    MyFavourite();*/
  });

  document.addEventListener('scroll', function () {
    if ($('.header-sticky').hasClass('sticky')) {
      $('.bottomnav-cart').show();
    } else {
      $('.bottomnav-cart').hide()
    }
  })

  $(".alert")
    .delay(3000)
    .fadeOut();

  $(document).on("click", ".buyNow", function () {
    let product_id = $(this).attr("data-id");
    const qty = $(".qty" + product_id).attr("data-qty");
    if (qty === 0) {
      var incQty = 1;
    } else {
      var incQty = Number(qty);
    }
    $(this).hide();
    storeToCart(product_id, incQty);
  });

  $(document).on("click", ".add-to-cart", function () {
    let product_id = $(this).attr("data-id");
    let qtyProductId = $(".qty" + product_id);
    const qty = qtyProductId.attr("data-qty");
    let incQty = qty > 0 ? Number(qty) + 1 : 1;
    $(".mpb" + product_id).removeClass("d-none");
    qtyProductId.removeClass("d-none");
    /*for product-details page*/
    $(".counterbag" + product_id).removeClass("d-none");
    $(".btnb" + product_id).removeClass("d-none");
    $(".bagadd" + product_id).addClass("d-none");
    qtyProductId.attr({"data-qty": incQty});
    qtyProductId.val(incQty);
    if (incQty > 0) {
      storeToCart(product_id, incQty);
    }
  });

  $(document).on("click", ".cartMinus", function () {
    let product_id = $(this).attr("data-id");
    let qtyProductId = $(".qty" + product_id);
    const qty = qtyProductId.attr("data-qty");
    let incQty = qty > 0 ? Number(qty) - 1 : 0;
    qtyProductId.attr({"data-qty": incQty});
    qtyProductId.val(incQty);
    $(".stockout" + product_id).addClass("d-none");
    if (incQty > 0) {
      updateToCart(product_id);
    } else {
      $(".qty" + product_id).addClass("d-none");
      $(".mpb" + product_id).addClass("d-none");
      destroyItem(product_id);
    }
  });

  function updateToCart(product_id) {
    $.ajax({
      method: "post",
      url: "{{ route('cart.update') }}",
      data: {product_id: product_id, _token: "{{csrf_token()}}"},
      dataType: "json",
      success: function (res) {
        carts();
      }
    });
  }

  function storeToCart(product_id, qty) {
    $.ajax({
      method: "post",
      url: "{{ route('cart.store') }}",
      data: {product_id: product_id, qty: qty, _token: "{{csrf_token()}}"},
      dataType: "json",
      success: function (res) {
        if (res === 0) {
          const cur_qty = Number(qty - 1);
          const id = product_id;
          let qtyId = $(".qty" + id);
          let stockOutId = $(".stockout" + id);
          qtyId.attr({"data-qty": cur_qty});
          qtyId.val(cur_qty);
          $(".message").html("Not in stock");
          var html = "";
          html +=
            '<span class="text text-danger text-bold text-center" style="font-size:11px">' +
            "Stock Limit (" +
            cur_qty +
            " Products Avl)" +
            "</span>";
          stockOutId.html(html);
          stockOutId.removeClass("d-none");
        } else {
          carts();
        }
      }
    });
  }

  function destroyItem(product_id) {
    $.ajax({
      method: "post",
      url: "{{ route('cart.destroy') }}",
      data: {product_id: product_id, _token: "{{ csrf_token() }}"},
      dataType: "json",
      success: function (res) {
        let qtyProduct = $(".qty" + product_id);
        qtyProduct.attr({"data-qty": 0});
        qtyProduct.val(0);
        carts();
      }
    });
  }

  function carts() {
    sessionStorage.clear();
    $.ajax({
      method: "get",
      url: "{{ route('cart.items') }}",
      dataType: "json",
      success: function (res) {
        $(".show-cart").html(res.items);
        $(".show-bag").html(res.show_bag);
        $(".bagsm").html(res.bagsm);
        $(".total-cart").text(res.totalAmount);
        $(".total-item").text(res.totalItem);
        $("#coupon").val(res.totalAmount);
        /* product qty assigning */
        /* after increment or decrement you have to show individual product qty amount which user added in  cart*/
        if (res.isEmpty !== true) {
          res.products.forEach((data, index) => {
            const cur_qty = res.qtys[index].qty;
            const id = data.product_id;
            let qtyItem = $(".qty" + id);
            qtyItem.attr({"data-qty": cur_qty});
            qtyItem.val(cur_qty);
            qtyItem.removeClass("d-none");
            $(".mpb" + id).removeClass("d-none");
            /*From details page*/
            $(".counterbag" + id).removeClass("d-none");
            $(".btnb" + id).removeClass("d-none");
            $(".bagadd" + id).addClass("d-none");
          });
        } else {
          $("#Checkout").css("pointer-events", "none");
        }
      }
    });
  }

  /* remove item from carts */
  $(document).on("click", ".destroyItem", function () {
    let product_id = $(this).attr("data-id");
    $.ajax({
      method: "post",
      url: "{{ route('cart.destroy') }}",
      data: {product_id: product_id, _token: "{{ csrf_token() }}"},
      dataType: "json",
      success: function (res) {
        let item = $(".qty" + product_id);
        item.val(0);
        item.addClass("d-none");
        item.attr({"data-qty": 0});
        $(".mpb" + product_id).addClass("d-none");
        $(".stockout" + product_id).addClass("d-none");
        carts();
      }
    });
  });

  /*function logincheck() {
    $.ajax({
      method: "get",
      url: "{{--{{ route('login_check') }}--}}",
      dataType: "json",
      success: function (res) {
        if (res.status == 1) {
          localStorage.setItem("logged", 1);
        } else {
          localStorage.setItem("logged", 0);
        }
      }
    });
    StoreFav();
  }*/


  /*
  =====================================
  * favorite start
  =====================================
  * */
  /*function StoreFav() {
    if (localStorage.getItem("logged") == 1) {
      var datas = JSON.parse(localStorage.getItem("favorite"));
      if (datas != null) {
        var len = datas.length;
        for (var j = 0; j < len; j++) {
          var product_id = datas[j]["product_id"];
          $.ajax({
            method: "post",
            url: "{{--{{ route('cart.favourite_storage') }}--}}",
            data: {product_id: product_id, _token: "{{--{{ csrf_token() }}--}}"},
            dataType: "json",
            success: function (res) {
              //console.log(res.status);
              datas.splice($.inArray(j, datas), 1);
              console.log(datas.length);
              localStorage.setItem("favorite", JSON.stringify(datas));
              isEmpty();
            }
          });
        }
        MyFavourite();
      }
    } else {
      var datas = JSON.parse(localStorage.getItem("favorite"));
      //console.log(datas.length);
      if (datas != null) {
        $("#fav").text(datas.length);
        for (var j = 0; j < datas.length; j++) {
          var product_id = datas[j]["product_id"];

          $(".favourite" + product_id).hide();
          $(".added" + product_id).removeClass("d-none");
        }
      } else {
        $("#fav").text(0);
      }
    }
  }

  function MyFavourite() {
    $.ajax({
      method: "get",
      url: "{{--{{ route('login_check') }}--}}",
      dataType: "json",
      success: function (res) {
        if (res.status == 1) {
          if (res.items != null) {
            $("#fav").text(res.items.length);
            $(res.items).each(function (index, item) {
              $(".favourite" + item.product_id).hide();
              $(".added" + item.product_id).removeClass("d-none");
            });
          } else {
            $("#fav").text(0);
          }
        }
      }
    });
  }

  /!* Add to favourite List *!/
  $(document).on("click", ".favourites-btn", function () {
    var product_id = $(this).attr("data-id");
    var name = $(this).data("name");
    if (name == "unchecked") {
      $(".favourite" + product_id).hide();
      $(".added" + product_id).removeClass("d-none");
    } else {
      $(".favourite" + product_id).show();
      $(".added" + product_id).addClass("d-none");
    }

    if (localStorage.getItem("logged") == 1) {
      $.ajax({
        method: "post",
        url: "{{--{{ route('cart.favourite') }}--}}",
        data: {product_id: product_id, _token: "{{--{{ csrf_token() }}--}}"},
        dataType: "json",
        success: function (res) {
          MyFavourite();
        }
      });
    } else {
      const products = [
        {
          product_id: product_id
        }
      ];

      var items = localStorage.getItem("favorite");

      if (!items) {
        localStorage.setItem("favorite", JSON.stringify(products));
      } else {
        var found = isExist(product_id);
        if (found != true) {
          var items = [];
          items = JSON.parse(localStorage.getItem("favorite"));
          items.push(products[0]);
          localStorage.setItem("favorite", JSON.stringify(items));
        }
      }
    }
    favorites();
  });

  function favorites() {
    var items = localStorage.getItem("favorite");
    console.log(items);

    var datas = JSON.parse(localStorage.getItem("favorite"));
    if (datas != null) {
      $("#fav").text(datas.length);
    } else {
      $("#fav").text(0);
    }
  }

  function isExist(id) {
    var datas = JSON.parse(localStorage.getItem("favorite"));
    var response = true;
    for (var j = 0; j < datas.length; j++) {
      if (id == datas[j]["product_id"]) {
        datas.splice(j, 1);
        response = true;
        break;
      } else {
        response = false;
      }
    }
    localStorage.setItem("favorite", JSON.stringify(datas));
    isEmpty();
    return response;
  }

  function isEmpty() {
    var items = localStorage.getItem("favorite");
    if (items && items.length == 2) {
      localStorage.removeItem("favorite");
    }
  }*/
  /*
  =====================================
  * favorite end
  =====================================
  * */

  $(document).on("keyup", ".mySearch", function (e) {
    var searchbox = $("#searchKey");
    var search = $("#searchKey").val();
    var category = $("#categorySearch").val();
    var searchResult = $("#searchReasults");
    searchResult.addClass("d-block");
    $(document).click(function () {
      var isClickInside = document
        .getElementById("searchReasults")
        .contains(event.target);
      if (!isClickInside) {
        hideOut();
      }
    });

    searchResult.focusout(hideOut);
    if (search.length == 0) {
      hideOut();
    }

    function hideOut() {
      searchResult.addClass("d-none");
      searchResult.removeClass("d-block");
    }

    // alert('sdf');

    if (search != null) {
      $.ajax({
        method: "post",
        url: "{{ route('mySearch') }}",
        data: {
          search: search,
          category_id: category,
          _token: "{{ csrf_token() }}"
        },
        datatype: "html",
        success: function (res) {
          searchResult.html(res);
        }
      });
    }

  });
</script>

</body>

</html>