<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
    <title>Famms - Product Details</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
@include('home.header')
<!-- header section ends -->

    <!-- Product Details Section -->
    <section class="product_details_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Product Details</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <h3>{{ $product->title }}</h3>
                        <p>{{ $product->description }}</p>
                        <h5>
                            @if ($product->discount_price)
                                <span style="text-decoration: line-through; color: #888;">
                                    EGP. {{ number_format($product->price, 2) }}
                                </span>
                                <span style="color: #e63946; font-weight: bold;">
                                    EGP. {{ number_format($product->discount_price, 2) }}
                                </span>
                            @else
                                <span style="color: #000; font-weight: bold;">
                                    EGP. {{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </h5>
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary mt-3">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details Section -->

    <!-- footer starts -->
@include('home.footer')
<!-- footer ends -->

    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
<!-- popper js -->
<script src="{{asset('home/js/popper.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('home/js/bootstrap.js')}}"></script>
<!-- custom js -->
<script src="{{asset('home/js/custom.js')}}"></script>
</body>
</html>
