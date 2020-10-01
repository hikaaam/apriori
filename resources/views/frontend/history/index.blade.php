@extends('layouts.frontend')
@section('content')
<div>
    <h1>
        <a style="color:navy" href="{{ url('', []) }}"><i class="fa fa-chevron-left"></i></a>
    </h1>
</div>
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
                            <td><a href="{{ asset($item->img) }}"><img style="width: 7.5em;height: 6em;" src="{{ asset($item->img) }}" alt=""></a></td>
                            <td>
                                @if ($item->status == 1)
                                    <b style="color:green;">{{"Terkonfirmasi"}}</b>
                                @else
                                    <b style="color:red;">{{"Belum dikonfirmasi"}}</b>
                                @endif
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
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
@endsection