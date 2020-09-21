@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <table class="table" id="example1">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Total Harga</td>
                    <td>Bukti TF</td>
                    <td>Status</td>
                    <td>edit</td>
                    <td>hapus</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$item->id_transaksi}}</td>
                        <td>Rp.{{$harga[$i]}} </td>
                        <td><img style="width: 7.5em;height: 6em;" src="{{ asset($item->img) }}" alt=""></td>
                        <td>
                            @if ($item->status == 1)
                                <b style="color:green;">{{"Terkonfirmasi"}}</b>
                            @else
                                <b style="color:red;">{{"Belum dikonfirmasi"}}</b>
                            @endif
                        </td>
                        <td> <a style="font-size: 3em;" href="{{ url('admin/transaction/'.$item->id, ['edit']) }}"><i class="fa fa-edit"></i></a> </td>
                        <td>
                            <form action="{{ url('admin/transaction', [$item->id]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-danger" type="submit" value="delete">
                            </form> 
                        </td>
                    </tr>
                    @php
                     $i++;   
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection