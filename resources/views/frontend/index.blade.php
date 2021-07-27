@extends('layouts.frontend')
@section('content')
    @isset($message)
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endisset
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: 1vh">
            <a class="btn btn-{{ $active === 'Semua' ? 'info' : 'success' }}" style="color:white" href="/">
                {{ 'Semua' }}
            </a>
            @foreach ($cat as $item)
                <a class="btn btn-{{ $active === $item->nama_kategori ? 'info' : 'success' }}" style="color:white"
                    href="{{ url('/cat', [$item->nama_kategori]) }}">
                    {{ $item->nama_kategori }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="row">
        @foreach ($data as $item)
            <div class="col-sm-3">
                <a href="{{ url('product', [$item->id]) }}">

                    <div class="card" style="width: 20rem; margin-bottom: 20px;">
                        <img class="card-img-top" src="{{ asset($item->img)}}"
                            style="width: 20rem;height:16rem;" alt="{{ $item->nama_barang }}">
                        <div class="card-body">
                            <p id="text" class="card-text"> {{ $item->nama_barang }}.</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <br>
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
@endsection
