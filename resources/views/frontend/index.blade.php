@extends('layouts.frontend')
@section('content')
<div class="row">
    @foreach ($data as $item)
    <div class="col-sm-3">
        <a href="{{ url('product', [$item->id]) }}">
            <div class="card" style="width: 20rem; margin-bottom: 20px;">
                <img class="card-img-top" src="{{$item->img}}" style="width: 20rem;height:16rem;" alt="Card image cap">
                <div class="card-body">
                    <p id="text" class="card-text"> {{$item->nama_barang}}.</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<br>

@endsection