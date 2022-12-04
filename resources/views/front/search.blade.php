@extends('front.include.master')
@section('content')



<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>{!! $aranan !!}</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Hakkında Arama Sonuçları</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            @if(count($search) == 0)
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <h2>Aradığınız "{{$aranan}}" hakkında sonuç bulamadık :/ </h2>
                </div>
            @endif
            @foreach($search as $data)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card text-center card-product">
                        <div class="card-product__img">
                            <img class="card-img" src="{{asset('front')}}/img/product/product2.png" alt="">
                            <ul class="card-product__imgOverlay">
                                <li><button><i class="ti-search"></i></button></li>
                                <li><button><i class="ti-shopping-cart"></i></button></li>
                                <li><button><i class="ti-heart"></i></button></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <p>Accessories</p>
                            <h4 class="card-product__title"><a href="single-product.html">{{$data->product_name}}</a></h4>
                            <p class="card-product__price">{{$data->fiyat}} ₺</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    {{$search->appends(['aranan' => old('aranan')])->links('pagination::bootstrap-4')}}
</section>

<!--================Instagram Area =================-->
<section class="instagram_area">
    <div class="container box_1620">
        <div class="insta_btn">
            <a class="btn theme_btn" href="#">Follow us on instagram</a>
        </div>
        <div class="instagram_image row m0">
            <a href="#"><img src="img/instagram/ins-1.jpg" alt=""></a>
            <a href="#"><img src="img/instagram/ins-2.jpg" alt=""></a>
            <a href="#"><img src="img/instagram/ins-3.jpg" alt=""></a>
            <a href="#"><img src="img/instagram/ins-4.jpg" alt=""></a>
            <a href="#"><img src="img/instagram/ins-5.jpg" alt=""></a>
            <a href="#"><img src="img/instagram/ins-6.jpg" alt=""></a>
        </div>
    </div>
</section>
<!--================End Instagram Area =================-->





@endsection
