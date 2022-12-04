@extends('back.include.master')
@section('content')



    @if ($errors->any())
        <div class="col-sm-3 col-md-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="post" action="{{route('admin.siparis.add',$siparis->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <h3 class="sub-header">
                        Sipariş {{$siparis->id > 0 ? 'Güncelle' : 'Kaydet'}}
                    </h3>
                </div>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{$siparis->id > 0 ? 'Güncelle' : 'Kaydet'}}
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adsoyad">Müşteri Adı</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Ürün Adı" value="{{old('name',$siparis->sepet->user->name)}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="username">E-Mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{old('email',$siparis->sepet->user->email)}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="username">Tel</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="{{old('phone',$siparis->sepet->user->detail->phone)}}">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Adress</label>
                    <input class="form-control" id="aciklama" name="aciklama" placeholder="Açıklama" value="{{old('address',$siparis->sepet->user->detail->address)}}"></input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="durum">Durum</label>
                    <select class="form-select" aria-label="Default select example" name="durum">
                        <option @if($siparis->durum == 'sipariş alındı') selected @endif>sipariş alındı</option>
                        <option @if($siparis->durum == 'kargo') selected @endif>kargo</option>
                        <option @if($siparis->durum == 'iptal') selected @endif>İptal</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Fiyat</label>
                    <input class="form-control" id="fiyat" name="fiyat" placeholder="fiyat" value="{{old('fiyat',$siparis->siparis_tutari)}}"></input>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Taksit</label>
                    <input class="form-control" id="aciklama" name="aciklama" placeholder="Açıklama" value="{{old('taksit',$siparis->taksit_sayisi)}}"></input>
                </div>
            </div>
        </div>

    </form>

    <br>
    <h3>--Siparişin Ürünleri--</h3>
    <hr>

    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fotoğraf</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ürün Adı</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ürün Adeti</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tutar</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kayıt Tarihi</th>
        </tr>
        </thead>

        <tbody>

        @foreach($siparis->sepet->sepet_product as $data)
        <tr>
            <td>
                <img src="{{asset($data->product->getDetail->images)}}" style="width: 150px;">
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$data->product->product_name}}</h6>
                    </div>
                </div>
            </td>
            <td>

                <p class="text-xs font-weight-bold mb-0">{{$data->adet}}</p>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">{{$data->fiyat}}</p>
            </td>
            <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{$data->created_at->diffForHumans()}}</span>
            </td>

        </tr>

        @endforeach
        </tbody>
    </table>

    <br>
@endsection


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection


