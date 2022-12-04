@extends('front.include.master')
@section('content')



<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shop</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
            <div class="col-xl-2 col-lg-3 col-md-4">
                <div class="sidebar-categories">
                    <div class="head">Kategoriler</div>
                    <ul class="main-categories">
                        <li class="common-filter">
                            <ul>
                                @foreach($categories as $categori )
                                   <a href="{{route('kategori',$categori->slug)}}"> <li class="filter-list"><label> {{$categori->kategori_adi}} </label></li></a> <br>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-7">

                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">

                        @foreach($products as $data)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{asset('front')}}/img/product/product1.png" alt="">
                                    <ul class="card-product__imgOverlay">

                                        <form method="post" action="{{route('postCard')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                        <li><button type="submit"><i class="ti-shopping-cart" ></i></button></li>
                                        </form>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{Str::limit($data->aciklama,20)}}</p>
                                    <h4 class="card-product__title"><a href="{{route('productdetail',$data->slug)}}">{{$data->product_name}}</a></h4>
                                    <p class="card-product__price">{{$data->fiyat}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </section>
                {{$products->links('pagination::bootstrap-4')}}
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



