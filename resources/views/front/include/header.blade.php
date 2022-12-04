<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyShop</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/linericon/style.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="{{asset('front')}}/vendors/nouislider/nouislider.min.css">


</head>
<body>
<!--================ Start Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="{{route('homepage')}}"><img src="{{asset('front')}}/img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item @if(Request::segment(1)=="home") active @endif "><a class="nav-link" href="{{route('homepage')}}">Home</a></li>
                        <li class="nav-item @if(Request::segment(1)=="shop") active @endif "><a class="nav-link" href="{{route('shoppage')}}">shop</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
                                <li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
                                <li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
                                <li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="tracking-order.html">Tracking</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                    @guest()
                    <ul class="nav-shop">
                        <li class="nav-item"><button id="myBtn"><i class="ti-search"></i></button></li>
                        <li class="nav-item"><a href="{{route('sepet')}}"><button><i class="ti-shopping-cart"></i></button></a></li>
                        <li class="nav-item"><a class="button button-header" href="{{route('login')}}">Giriş Yap</a></li>
                    </ul>
                    @endguest

                    @auth()
                    <ul class="nav-shop">
                        <li class="nav-item"><button id="myBtn"><i class="ti-search"></i></button></li>
                        <li class="nav-item"><a href="{{route('sepet')}}"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">{{Cart::count()}}</span></button></a></li>

                        <li class="nav-item submenu dropdown">
                            <a href="#" class="button button-header dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>

                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="login.html">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('gecmis.siparisler')}}">Geçmiş Siparişler</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış Yap</a>
                                    <form id="logout-form" method="post" action="{{route('logout')}}" style="display: none;">
                                       @csrf
                                    </form>
                                </li>
                                <li></li>
                            </ul>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(236,236,236,0.93);">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="model-title" style="width: 1400px; position: relative; left: 50%; margin-left: -40px;">

                    </div>
                    <div class="modal-body">

                        <form action="{{route('search')}}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-10">
                                        <div class="form-group">
                                            <input name="aranan" type="text" class="form-control" placeholder="&#129488; &#129300;" value="{{old('aranan')}}">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <button type="submit" class="btn btn-default"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->

        <!-- Modal -->


    </div>
</header>
<!--================ End Header Menu Area =================-->





