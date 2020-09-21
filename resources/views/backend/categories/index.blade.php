@extends('layouts.backend')
<style>
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <td>Nama Kategori</td>
                        <td>edit</td>
                        <td>hapus</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->nama_kategori}}</td>
                            <td> <a style="font-size: 3em;" href="{{ url('admin/categories/'.$item->id, ['edit']) }}"><i class="fa fa-edit"></i></a> </td>
                            <td>
                                <form action="{{ url('admin/categories', [$item->id]) }}" method="POST">
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