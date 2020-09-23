@extends('layouts.frontend')
@section('content')
<div>
    <h1>
        <a style="color:navy" href="{{ url('', []) }}"><i class="fa fa-chevron-left"></i></a>
    </h1>
</div>
<div class="row">
    <div id="show-product" class="col-sm-8">
        <div class="img-show">
            <div class="d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset($product->img) }}" alt="">
            </div>
        </div>
        <div class="show-ket">
            <div class="d-flex justify-content-end">
                <h1>
                    {{ucfirst($product->nama_barang)}}
                </h1>
            </div>
            <div class="d-flex justify-content-end">
                <p>
                    Rp. {{$product->harga}}
                </p>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-info" onclick="goTo('{{ url('product/'.$product->id.'/edit', []) }}')">
                    Tambahkan ke keranjang
                    <i class="fa fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="show-apriori">
            <div class="row">
                <p class="col-sm-12"><b>User yang beli ini juga membeli barang ini :</b></p>
                @foreach ($data as $item)
                <div id="show-apriori-item" class="col-sm-6">
                    <div class="card">
                        <a href="{{ url('product', [$item->id]) }}"><img class="img-fluid" src="{{$item->img}}"
                                alt=""></a>
                        <div class="card-body">
                            <h5 class="card-title">{{$item->nama_barang}}</h5>
                            <p class="card-text">Rp.{{$item->harga}} </p>
                        </div>
                    </div>       
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>







@endsection