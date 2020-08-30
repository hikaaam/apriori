@extends('layouts.backend')
<style>
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Harga</td>
                        <td>Foto</td>
                        <td>id_kategori</td>
                        <td>edit</td>
                        <td>hapus</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->nama_barang}}</td>
                            <td>{{$item->harga}}</td>
                            <td><img style="width: 7.5em;height: 6em;" src="{{ asset($item->img) }}" alt=""></td>
                            <td>{{$item->id_kategori}}</td>
                            <td> <a style="font-size: 3em;" href="{{ url('admin/product/'.$item->id, ['edit']) }}"><i class="fa fa-edit"></i></a> </td>
                            <td>
                                <form action="{{ url('admin/product', [$item->id]) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <input class="btn btn-danger" type="submit" value="delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection