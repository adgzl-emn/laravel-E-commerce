@extends('front.include.master')
@section('content')



<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shop Category</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!-- ================ category section start ================= -->
<section class="section-margin--small mb-12">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-filter">
                    <div class="top-filter-head">Kategori Detay</div>
                    <div class="common-filter">
                        <div class="head">{{$categories->kategori_adi}}</div>
                        <form action="#">
                            <ul>
                                @foreach($alt_kategori as $data)
                                <li class="filter-list"><label for="apple">{{$data->kategori_adi}}</label></li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div>
                        <div class="input-group filter-bar-search">
                            <input type="text" placeholder="Search">
                            <div class="input-group-append">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">

                        @if(count($getProducts) == 0 )
                            <div class="col-md-12 col-lg-12">
                                <p>Bu Kategoriye Ait ??r??n Bulunmamaktad??r. :(</p><br>
                                <p>Top ??r??nleri ??nceleyebilirsiniz</p>
                                <!-- ================ top product area start ================= -->
                                <section class="related-product-area">
                                    <div class="container">
                                        <div class="section-intro pb-60px">
                                            <h2>Top <span class="section-intro__style">Product</span></h2>
                                        </div>
                                        <div class="row mt-30">
                                            <div class="col-sm-6 col-xl-6 mb-4 mb-xl-0">
                                                <div class="single-search-product-wrapper">
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="{{asset('front')}}/img/product/product-sm-1.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="{{asset('front')}}/img/product/product-sm-2.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="{{asset('front')}}/img/product/product-sm-3.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6 mb-4 mb-xl-0">
                                                <div class="single-search-product-wrapper">
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="img/product/product-sm-1.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="img/product/product-sm-2.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                    <div class="single-search-product d-flex">
                                                        <a href="#"><img src="img/product/product-sm-3.png" alt=""></a>
                                                        <div class="desc">
                                                            <a href="#" class="title">Gray Coffee Cup</a>
                                                            <div class="price">$170.00</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- ================ top product area end ================= -->
                            </div>
                        @endif

                        @foreach($getProducts as $urun)
                            <div class="col-md-6 col-lg-4">
                                <div class="card text-center card-product">
                                    <div class="card-product__img">
                                        <img class="card-img" src="{{asset('front')}}/img/product/product2.png" alt="">
                                        <ul class="card-product__imgOverlay">
                                            <li><button><a  href="{{route('productdetail',$urun->slug)}}" ><i class="ti-search"></i></a></button></li>
                                            <li><button><i class="ti-shopping-cart"></i></button></li>
                                            <li><button><i class="ti-heart"></i></button></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <p>Beauty</p>
                                        <h4 class="card-product__title"><a href="{{route('productdetail',$urun->slug)}}">{{$urun->product_name}}</a></h4>
                                        <p class="card-product__price">{{$urun->fiyat}} ???</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </section>
                {{$getProducts->links('pagination::bootstrap-4')}}
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
</section>
<!-- ================ category section end ================= -->



<!-- ================ Subscribe section start ================= -->
<section class="subscribe-position">
    <div class="container">
        <div class="subscribe text-center">
            <h3 class="subscribe__title">Get Update From Anywhere</h3>
            <p>Bearing Void gathering light light his eavening unto dont afraid</p>
            <div id="mc_embed_signup">
                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
                    <div class="form-group ml-sm-auto">
                        <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" >
                        <div class="info"></div>
                    </div>
                    <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                    <div style="position: absolute; left: -5000px;">
                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
<!-- ================ Subscribe section end ================= -->






@endsection
