@extends('back.include.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Kategori Tablosu</h6>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-link text-dark px-3 mb-0" href="{{route('admin.kategori.edit')}}"><i class="fas fa-user text-dark me-2" aria-hidden="true"></i>Ekle</a>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <a class="input-group-text text-body" href=""><i class="fas fa-backspace" aria-hidden="true"></i></a>

                                    <form method="post" action="{{route('admin.kategoriler')}}">
                                        @csrf
                                        <input type="text" class="form-control" placeholder="Type here..." name="aranan" value="{{old('aranan')}}">


                                        <select class="form-select" id="anakategori" name="anakategori" aria-label="Default select example">
                                            <option value="">Ana Kategoriler</option>
                                            @foreach($anacategorys as $anacategory)
                                            <option value="{{ $anacategory->id }}" {{ old('anakategori') == $anacategory->id ? 'selected' : '' }}>
                                                {{ $anacategory->kategori_adi }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-search" aria-hidden="true"></i></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori Ad??</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">??st Kategori</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kay??t Tarihi</th>
                                    <th class="text-secondary opacity-7">????lemler</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($categories as $data)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$data->kategori_adi}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$data->ust_category->kategori_adi}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$data->slug}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$data->created_at->diffForHumans()}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="{{route('admin.kategori.edit',$data->id)}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="{{route('admin.kategori.delete',$data->id)}}" onclick="return confirm('Kay??t Silinicek Emin misin?')"><i class="fas fa-trash text-dark me-2" aria-hidden="true"></i>Sil</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            {{$categories->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
