@extends('layouts.backend')
@section('content')

<form action="{{ url('admin/categories', [$data->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row" style="width: 100%;padding-left:3%;">
        <h3 style="font-weight: bold;font-size: 1.5em;text-decoration: underline 2px;" class="col-sm-12">categories >
            Edit categories<br><br></h3>

        <div class="col-sm-7">
            <label for="copyright">Nama Kategori</label>
            <br>
            <input required type="text" name="nama_kategori" class="form-control" value="{{$data->nama_kategori}}">
            <br>
        </div>
      
        <div class="col-sm-7">
            <br>
            <input style="width:100%;text-align: center" class="btn btn-success" type="submit" value="edit categories">
            <br>
            <br>
        </div>
    </div>
</form>
@endsection