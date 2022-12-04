@extends('front.include.master')
@section('content')


<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Geçmiş Siparişler</h1>
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
                @if(count($siparisler) == 0 )
                    <h3>Henüz Bir Siparişiniz Yok :(</h3>
                @else

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Sipariş Kodu</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Ödenen Miktar</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Detay</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($siparisler as $data)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-body">
                                    <p>
                                        SP-000{{$data->id}}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="media">
                                <div class="media-body">
                                    <p>{{$data->sepet->sepet_urun_adet()}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="product_count">
                                {{$data->siparis_tutari + (($data->siparis_tutari * config('cart.tax')) /100) }} ₺
                            </div>
                        </td>
                        <td>
                            <h5>{{$data->durum}}</h5>
                        </td>
                        <td>
                            <a href="{{route('siparis.detay',$data->id)}}">
                            <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com/dnmvmpfk.json"
                                trigger="hover"
                                style="width:40px;height:40px">
                            </lord-icon>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->






@endsection
