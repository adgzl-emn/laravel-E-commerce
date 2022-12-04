@extends('front.include.master')
@section('content')



<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Already have an account?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="button button-account" href="{{route('login')}}">Login Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="login_form_inner register_form_inner">
                    @include('front.include.errors')
                    <h3>Hesap Oluştur</h3>

                    <form method="post" class="row login_form" action="{{route('registerpost')}}" id="register_form" >
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ad Soyad" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ad Soyad'" value="{{old('name')}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" value="{{old('username')}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Addresi" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Addresi'" value="{{old('email')}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Şifre'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Şifre Tekrarı" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Şifre Tekrarı'">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-register w-100">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->


@endsection
