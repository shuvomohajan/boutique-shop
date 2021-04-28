@extends('website.layouts.website')
@section('content')
<div class="body-wrapper">

    <!-- Header Area End Here -->
    <!-- Begin FB's Breadcrumb Area -->
    <div class="breadcrumb-area pt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Breadcrumb Area End Here -->
    <!--Wishlist Area Strat-->
    <div class="wishlist-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="fb-product-remove">remove</th>
                                    <th class="fb-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="fb-product-price">Unit Price</th>
                                    <th class="fb-product-stock-status">Stock Status</th>
                                    <th class="fb-product-add-cart">add to cart</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/1.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Giro Civilia</a></td>
                                    <td class="fb-product-price"><span class="amount">$23.39</span></td>
                                    <td class="fb-product-stock-status"><span class="in-stock">in stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/2.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Pro Bike Shoes</a></td>
                                    <td class="fb-product-price"><span class="amount">$30.50</span></td>
                                    <td class="fb-product-stock-status"><span class="in-stock">in stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/3.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Nero Urban Shoes</a></td>
                                    <td class="fb-product-price"><span class="amount">$40.19</span></td>
                                    <td class="fb-product-stock-status"><span class="in-stock">out stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/4.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Nero Urban Shoes</a></td>
                                    <td class="fb-product-price"><span class="amount">$40.19</span></td>
                                    <td class="fb-product-stock-status"><span class="out-stock">out stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/5.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Nero Urban Shoes</a></td>
                                    <td class="fb-product-price"><span class="amount">$40.19</span></td>
                                    <td class="fb-product-stock-status"><span class="in-stock">out stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                <tr>
                                    <td class="fb-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td class="fb-product-thumbnail"><a href="#"><img src="{{asset('/')}}website/Images/product-thumb/6.png" alt=""></a></td>
                                    <td class="fb-product-name"><a href="#">Nero Urban Shoes</a></td>
                                    <td class="fb-product-price"><span class="amount">$40.19</span></td>
                                    <td class="fb-product-stock-status"><span class="out-stock">out stock</span></td>
                                    <td class="fb-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Wishlist Area End-->
    <!-- Begin FB's Branding Area -->
    <div class="fb-branding-wrap pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fb-branding bg-white">
                        <div class="fb-branding_active owl-carousel">
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/1.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/2.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/3.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/4.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/5.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/6.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/1.jpg" alt="FB's Branding">
                                </a>
                            </div>
                            <div class="branding-item">
                                <a href="#">
                                    <img src="{{asset('/')}}website/Images/branding/2.jpg" alt="FB's Branding">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Branding Area End Here -->
    <!-- Begin FB's Footer Area -->

    <!-- FB's Footer Area End Here -->
</div>

@endsection
