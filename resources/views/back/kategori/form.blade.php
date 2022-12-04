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

    <form method="post" action="{{route('admin.kategori.add',$categories->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <h3 class="sub-header">
                        Kullanıcı {{ $categories->id > 0 ? "Güncelle" : "Kayıt" }}
                    </h3>
                </div>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ $categories->id > 0 ? "Güncelle" : "Kaydet" }}
                </button>
            </div>
        </div>

        <div class="col-md-6">
            <label for="adsoyad">Üst Kategori Seçimi </label>
            <select class="form-select" aria-label="Default select example" name="ust_id">
                <option value="" selected>Ana Kategori</option>
                @foreach($allcategori as $data)
                    <option value="{{$data->id}}">{{$data->kategori_adi}}</option>
                @endforeach

            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adsoyad">Kategori Adı</label>
                    <input type="text" class="form-control" id="kategori_adi" name="kategori_adi" placeholder="kategori Adi" value="{{ old('kategori_adi  ',$categories->kategori_adi) }}">
                </div>
            </div>
        </div>



    </form>

@endsection

