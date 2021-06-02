<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ companyInfo()->name }}</title>

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
@php($categories = \App\Model\Category::where('status', 1)->get())
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
                @if(isset(companyInfo()->mobile1))
                  <li class="phone"><span>Mobile: </span><a href="callto://+123123321345">{{ companyInfo()->mobile1 }} {{ companyInfo()->mobile2 ? ', ' . companyInfo()->mobile2 : null }}</a></li>
                @endif
                @if(isset(companyInfo()->email))
                  <li class="email"><span>Email: </span><a href="mailto://info@yourdomain.com">{{ companyInfo()->email }}</a></li>
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
                    <button class="dropdown-toggle">Account<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-menu">
                      <ul>
                        @guest
                          <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          @if (Route::has('register'))
                            <li>
                              <a href="{{ route('register') }}">{{ __('Registration') }}</a>
                            </li>
                          @endif
                        @else
                          <li>
                            <a href="{{ route('dashboard') }}">{{ __('Account') }}</a>
                          </li>
                          <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
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
              @if(isset(companyInfo()->logo))
              <img src="{{asset('storage/' . companyInfo()->logo )}}" alt="{{ companyInfo()->name }}">
              @else
              <h4 class="text-white">{{ companyInfo()->name }}</h4>
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

                <option value="">Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endForeach
              </select>
              <input type="text" class="mySearch" placeholder="Search Here ..." id="searchKey" name="search" autocomplete="off">
              <button class="fb-search_btn" type="submit"><i class="fa fa-search"></i></button>
              <div id="searchReasults" class="border position-absolute bg-white d-none"></div>
            </form>
            <!-- Header Middle Searchbox Area End Here -->
            <ul class="hm-menu midnav-cart">
              <!-- Begin Header Mini Cart Area -->
              <li class="hm-minicart">
                <div class="hm-minicart-trigger">
                  <span class="item-icon"></span>
                  <span class="item-text">Cart

                      <span class="cart-item-count total-item">0.00tk</span>
                    </span>
                  <span class="item-total total-cart">0.00tk</span>
                </div>
                <span></span>
                <div class="minicart">
                  <ul class="minicart-product-list show-cart">
                  </ul>
                  <div class="price-content">
                    <p class="minicart-total">Total<span class=""> &#2547;<span class="total-cart">0.00tk</span></span></p>
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
        <div class="col-lg-10 d-none d-lg-block">
          <!-- FB's Navigation -->
          <nav class="fb-navigation">
            <ul>
              <li class="active">
                <a href="{{ url('/') }}">Home</a>
              </li>

              <li class="megamenu-holder">
                <a href="javascript:">Category</a>
                <ul class="megamenu">
                  @foreach ($categories->take(39)->chunk(8) as $categoriesChunk)
                    @php($lastItem = $loop->last ? true : false)
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
              {{-- <li>
                <a href="{{ route('allPost.index') }}">Blog</a>
              </li> --}}
              <li>
                <a href="{{url('about-us')}}">About Us</a>
              </li>
              <li>
                <a href="{{ url('customer_support') }}">Contact</a>
              </li>
              <li>
                <a href="{{ route('custom_product') }}">Custom Product</a>
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
                <span class="item-text">Cart

                      <span class="cart-item-count total-item">0</span>
                    </span>
                <span class="item-total total-cart">0.00tk</span>
              </div>
              <span></span>
              <div class="minicart">
                <ul class="minicart-product-list show-cart">
                </ul>
                <div class="price-content">
                  <p class="minicart-total">Total<span class=""> &#2547;<span class="total-cart">0.00tk</span></span></p>
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
<!-- Footer Top Area End Here -->
  <!-- Begin FB's Footer Middle Area -->
  <div class="fb-footer_middle bg-white">
    <div class="container">
      <!-- Begin Footer Middle Top Area -->
      <div class="footer-middle_top">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-sm-6">
                <div class="fb-footer_widget fb-footer_widget-3 pt-20">
                  <h3 class="fb-footer-widget-headeing">Categories</h3>
                  <ul>
                    @foreach($categories->take(6) as $category)
                      <li><a href="{{ route('all.products', ['category', $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-sm-6">
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
              <a href="{{ url('/') }}">
                @if(companyInfo()->footer_logo)
                  <img src="{{ asset('storage/' . companyInfo()->footer_logo) }}" alt="{{ companyInfo()->name }}">
                @else
                  <h4>{{ companyInfo()->name }}</h4>
                @endif
              </a>
            </div>
            <div class="footer-widget-info">
              <p class="footer-widget_short-desc">{{ companyInfo()->about_footer }}</p>
              <div class="footer-widget-social-link footer-widget-social-link-3">
                <ul class="social-link">
                  @if(isset(companyInfo()->facebook))
                    <li class="facebook">
                      <a href="{{ companyInfo()->facebook }}" data-toggle="tooltip" target="_blank" title="Facebook">
                        <i class="fa fa-facebook"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset(companyInfo()->twitter))
                    <li class="twitter">
                      <a href="{{ companyInfo()->twitter }}" data-toggle="tooltip" target="_blank" title="Twitter">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset(companyInfo()->whatsapp))
                    <li class="youtube">
                      <a href="{{ companyInfo()->whatsapp }}" data-toggle="tooltip" target="_blank" title="Youtube">
                        <i class="fa fa-whatsapp"></i>
                      </a>
                    </li>
                  @endif
                  @if(isset(companyInfo()->instagram))
                    <li class="instagram">
                      <a href="{{ companyInfo()->instagram }}" data-toggle="tooltip" target="_blank" title="Instagram">
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
            <span>Copyright &copy; 2021 <a href="{{ url('/') }}">{{ companyInfo()->name }}.</a> All rights reserved.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer Bottom Area End Here -->
</div>


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
