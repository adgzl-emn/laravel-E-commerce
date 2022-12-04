@extends('front.include.master')
@section('content')



<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Ödeme</h3>

                    <form class="needs-validation" method="post" action="{{route('odeme.yap')}}">
                       @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Kartın 16 Haneli Numarası</label>
                                <input name="kart_no" type="text" class="form-control" minlength="16" maxlength="16" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Son Kullanma Tarihi</label>
                                <input name="son_kullanma_tarihi" type="text" class="form-control" id="cc-expiration" maxlength="4" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input name="cvv" type="text" class="form-control" maxlength="3" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>




                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#"><h4>Ürün <span>Tutar</span></h4></a></li>
                            @foreach(Cart::content() as $productDetail)
                            <li><a href="#">{{$productDetail->name}} <span class="middle">x {{$productDetail->qty}}</span> <span class="last">{{$productDetail->subtotal}} ₺</span></a></li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span>{{Cart::subtotal()}} ₺</span></a></li>
                            <li><a href="#">KDV <span>{{Cart::tax()}} ₺</span></a></li>
                            <li><a href="#">Ödenecek Miktar <span> {{Cart::total()}} ₺</span></a></li>
                        </ul>


                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        <div class="text-center">
                            <a class="button button-paypal" href="#">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->



@endsection

