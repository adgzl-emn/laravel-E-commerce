@extends('front.include.master')
@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>SP-000{{$detail->id}}</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homepage')}}">Anasayfa</a></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->



<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ürün</th>
                        <th scope="col">Price</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Total</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($detail->sepet->sepet_product as $data)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <a href="{{route('productdetail',$data->product->slug)}}">
                                        <img src="{{asset('front')}}/img/cart/cart3.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="media-body">
                                <p>{{$data->product->product_name}}</p>
                            </div>
                        </td>
                        <td>
                            <h5>
                                {{$data->fiyat}}
                            </h5>
                        </td>
                        <td>
                            <div class="product_count">
                                {{$data->adet}}
                            </div>
                        </td>
                        <td>
                            <h5>
                                {{$data->fiyat * $data->adet}}
                            </h5>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td> <h5>Toplam Tutar</h5> </td>
                        <td></td>
                        <td>
                            {{$detail->siparis_tutari}} ₺
                        </td>
                    </tr>
                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td> <h5>KDV</h5></td>
                        <td></td>
                        <td>
                            {{$detail->durum}}
                        </td>
                    </tr>
                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td><h5>Ödenecek Miktar</h5></td>
                        <td></td>
                        <td>
                            <h5> {{$detail->siparis_tutari + (($detail->siparis_tutari * config('cart.tax')) /100) }}₺</h5>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->






@endsection
