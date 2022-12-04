@extends('front.include.master')
@section('content')

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                @if(count(Cart::content()) > 0)
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ürün</th>
                        <th scope="col">Adet Fiyatı</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::content() as $productCard)
                    <tr>

                        <td scope="row">
                            <form method="post" action="{{route('sepet.kaldir',$productCard->rowId)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>

                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="{{asset('front')}}/img/cart/cart1.png" alt="" width="100">
                                </div>
                            </div> <br>
                            <div class="media-body">
                                <a href="{{ route('productdetail',$productCard->options->slug) }}">{{$productCard->name}}</a>

                            </div>
                        </td>

                        <td>
                            <h5>{{$productCard->price}} ₺</h5>
                        </td>

                        <td>
                            <div class="product_count">
                                <input type="text" name="qty" maxlength="12" value="{{$productCard->qty}}" title="Quantity:"
                                       class="input-text qty" readonly>
                                <button class="increase items-count urun-adet-artir" type="button"
                                data-id = "{{$productCard->rowId}}" data-adet = "{{$productCard->qty+1}}" >
                                    <i class="lnr lnr-chevron-up"></i>
                                </button>
                                <button class="reduced items-count urun-adet-azalt" type="button"
                                        data-id = "{{$productCard->rowId}}" data-adet = "{{$productCard->qty-1}}" >
                                    <i class="lnr lnr-chevron-down"></i>
                                </button>
                            </div>
                        </td>

                        <td>
                            <h5>{{$productCard->subtotal}}</h5>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td> <h5>Toplam Tutar</h5> </td>
                        <td></td>
                        <td>
                            {{Cart::subtotal()}}₺
                        </td>
                    </tr>
                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td> <h5>KDV</h5></td>
                        <td></td>
                        <td>
                            {{Cart::tax()}}₺
                        </td>
                    </tr>
                    <tr class="bottom_button text-right">
                        <td></td>
                        <td></td>
                        <td><h5>Ödenecek Miktar</h5></td>
                        <td></td>
                        <td>
                            <h5>{{Cart::total()}}₺</h5>
                        </td>
                    </tr>
                    </tbody>
                </table>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <form method="post" action="{{route('sepet.bosalt')}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Sepeti Boşalt</button>
                                </form>


                            </div>
                            <div class="col-sm">
                            </div>
                            <div class="col-sm text-right">
                                <a href="{{route('odeme')}}" class="btn btn-success pull-right">Ödemeye Geç</a>
                            </div>
                        </div>
                    </div>
                @else
                    <h3>Sepetiniz Boş :( </h3>
                    <br>
                    <a href="{{route('shoppage')}}">
                        Hadi Dolduralım
                    </a>
                @endif
            </div>


        </div>

    </div>

</section>
<!--================End Cart Area =================-->


@endsection

@section('ajax')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script>


        $('.urun-adet-artir, .urun-adet-azalt').on('click', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = $(this).attr('data-id');
            var adet = $(this).attr('data-adet');

            $.ajax({
                type: 'PATCH',
                url : '/sepet/guncelle' + id,
                data : { adet: adet } ,
                success : function () {
                    window.location.href = '/sepet';
                }
            });
        });

    </script>
@endsection
