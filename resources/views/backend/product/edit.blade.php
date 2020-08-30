@extends('layouts.backend')
@section('content')

<form action="{{ url('admin/product', [$data->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row" style="width: 100%;padding-left:3%;">
        <h3 style="font-weight: bold;font-size: 1.5em;text-decoration: underline 2px;" class="col-sm-12">Product >
            Edit Product<br><br></h3>
        <div class="col-sm-7">
            <label for="tentang">Kategori</label>
            <br>
            <select class="form-control" name="id_kategori" id="">
                @foreach ($kategori as $item)
                    <option @if($data->id_kategori == $item->id){{'selected="selectted"'}}@endif value="{{$item->id}}">
                    {{$item->nama_kategori}}</option>
                @endforeach
            </select>
            <br>
        </div>
        <div class="col-sm-7">
            <label for="copyright">Nama Barang</label>
            <br>
            <input required type="text" name="nama_barang" class="form-control" value="{{$data->nama_barang}}">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="facebook">Harga</label>
            <br>
            <input required type="number" name="harga" value="{{$data->harga}}" class="form-control">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="instagram">Foto Product</label>
            <br>
            <img style="width: 7.5em;height: 6em;" src="{{ asset($data->img) }}" alt="">
            <input type="file" name="img" class="form-control">
            <br>
        </div>
        <div class="col-sm-7">
            <br>
            <input style="width:100%;text-align: center" class="btn btn-success" type="submit" value="edit product">
            <br>
            <br>
        </div>
    </div>
</form>
@endsection