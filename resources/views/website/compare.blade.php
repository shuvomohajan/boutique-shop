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
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Compare</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Breadcrumb Area End Here -->
    <!-- Begin Compare Area -->
    <div class="compare-area pt-60 pb-60">
        <div class="container">
            <div class="compare-table table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <tbody>
                    <tr>
                        <th class="compare-column-titles">Image</th>
                        <td class="compare-column-productinfo">
                            <div class="compare-pdoduct-image">
                                <a href="single-product.html">
                                    <img src="{{asset('/')}}website/Images/product/2-9_1.jpg" alt="Product Image">
                                </a>
                                <a href="cart.html" class="ho-button ho-button-sm">
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </td>
                        <td class="compare-column-productinfo">
                            <div class="compare-pdoduct-image">
                                <a href="single-product.html">
                                    <img src="{{asset('/')}}website/Images/product/2-9_2.jpg" alt="Product Image">
                                </a>
                                <a href="cart.html" class="ho-button ho-button-sm">
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>
                            <h5 class="compare-product-name"><a href="single-product.html">Sanai</a></h5>
                        </td>
                        <td>
                            <h5 class="compare-product-name"><a href="single-product.html">Meito</a></h5>
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>Impressively thin and light, the HP Pavilion G6 empowers users to create,
                            connect, and collaborate, using enterprise-class performance</td>
                        <td>Impressively thin and light, the HP ProBook 450 G4 empowers users to create,
                            connect, and collaborate, using enterprise-class performance</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>$800</td>
                        <td>$1020</td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td>Black</td>
                        <td>Red</td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>Medium</td>
                        <td>Large</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>In Stock</td>
                        <td>Stock Out</td>
                    </tr>
                    <tr>
                        <th>Rating</th>
                        <td>
                            <div class="li-pro-rating li-rattingbox">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o li-star"></i></span>
                                <span><i class="fa fa-star-o li-star"></i></span>
                            </div>
                        </td>
                        <td>
                            <div class="li-pro-rating li-rattingbox">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o li-star"></i></span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Compare Area End Here -->
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
<!-- Body Wraper Area End Here -->
<!-- JS
============================================ -->
@endsection
