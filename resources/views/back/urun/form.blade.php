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

    <form method="post" action="{{route('admin.urun.add',$urun->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <h3 class="sub-header">
                        Ürün {{$urun->id > 0 ? 'Güncele' : 'Kaydet'}}
                    </h3>
                </div>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{$urun->id > 0 ? 'Güncele' : 'Kaydet'}}
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adsoyad">Ürün Adı</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Ürün Adı" value="{{old('product_name',$urun->product_name)}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="username">Fiyat</label>
                    <input type="text" class="form-control" id="fiyat" name="fiyat" placeholder="Fiyat" value="{{old('fiyat',$urun->fiyat)}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    @if($urun->getDetail->image != null)
                        <img src="{{ asset('uploads/urunler/' . $urun->getDetail->image) }}" style="height: 100px; margin-right: 25px;" class="img-thumbnail pull-right">
                    @endif

                    <input type="file" class="form-control-file" id="urun_image" name="urun_image">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Açıklama</label>
                    <textarea class="form-control" id="aciklama" name="aciklama" placeholder="Açıklama">{{old('aciklama',$urun->aciklama)}}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="checkbox">
                    <label for="goster_slider">
                        <input type="hidden" name="goster_slider" value="0">
                        <input type="checkbox" name="goster_slider" value="1" @if(isset($urun->getDetail->goster_slider) && $urun->getDetail->goster_slider == 1) checked @endif>
                        Slider Göster
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox">
                    <label for="goster_gunun_firsati">
                        <input type="hidden" name="goster_gunun_firsati" value="0">
                        <input type="checkbox" name="goster_gunun_firsati" value="1" @if(isset($urun->getDetail->goster_gunun_firsati) && $urun->getDetail->goster_gunun_firsati == 1) checked @endif>
                        Günün Fırsatı
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox">
                    <label for="goster_one_cikan">
                        <input type="hidden" name="goster_one_cikan" value="0">
                        <input type="checkbox" name="goster_one_cikan" value="1"  @if(isset($urun->getDetail->goster_one_cikan) && $urun->getDetail->goster_one_cikan == 1) checked @endif>
                        Öne Çıkan
                    </label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="checkbox">
                    <label for="goster_cok_satan">
                        <input type="hidden" name="goster_cok_satan" value="0">
                        <input type="checkbox" name="goster_cok_satan" value="1"  @if(isset($urun->getDetail->goster_cok_satan) && $urun->getDetail->goster_cok_satan == 1) checked @endif>
                        Çok Satan
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox">
                    <label for="goster_indirimli">
                        <input type="hidden" name="goster_indirimli" value="0">
                        <input type="checkbox" name="goster_indirimli" value="1"  @if(isset($urun->getDetail->goster_indirimli) && $urun->getDetail->goster_indirimli == 1) checked @endif>
                        İndirimli
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <p>
                <select name="secilen_kategoriler[]" class="js-example-basic-multiple" multiple="multiple"  tabindex="-1" aria-hidden="true">
                    <optgroup label=" *********** Lütfen Uygun Olan Kategoriyi Seçin *********** " data-select2-id="select2-data-136-lfr9">
                        @foreach($kategoriler as $kategori)
                            <option value="{{$kategori->id}}"
                                {{collect(old('$kategoriler',$urun_kategoriler))->contains($kategori->id) ? 'selected' : ''}}    >
                                {{$kategori->kategori_adi}}
                            </option>
                        @endforeach
                    </optgroup>

                </select>
            </p>
        </div>

    </form>

    <br>
@endsection


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#aciklama').summernote({
                'height': 400
            });
        });
    </script>
@endsection
