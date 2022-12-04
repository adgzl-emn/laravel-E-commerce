@extends('back.include.master')
@section('content')



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('admin.kullanici.add',$user->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <h3 class="sub-header">
                        Kullanıcı {{ $user->id > 0 ? "Güncelle" : "Kayıt" }}
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ $user->id > 0 ? "Güncelle" : "Kaydet" }}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adsoyad">Ad Soyad</label>
                    <input type="text" class="form-control" id="adsoyad" name="name" placeholder="Ad Soyad" value="{{ old('name',$user->name) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username',$user->username) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email',$user->email) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Şifre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Adres" value="{{ old('address',$user->detail->address) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="postcode">Posta Kodu</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode',$user->detail->postacode) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="tel">Telefon</label>
                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Cep Telefonu" value="{{ old('tel',$user->detail->phone) }}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>

                <input type="checkbox" name="active" value="1" @if($user->active == 1) checked @endif> Aktif Mi
            </label>
        </div>
        <div class="checkbox">
            <label>

                <input type="checkbox" name="admin_check" value="1"  @if($user->admin_check == 1) checked @endif> Yönetici Mi
            </label>
        </div>
    </form>

@endsection

