@extends('layouts.frontend')
@section('content')
<div class="container">
    <form action="{{ url('product', [$id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-3">
            </div>
                <div class="col-md-5">
                <div>
                    <h4>Silahkan Transfer ke nomor rekening : {{"213124441214144 (BRI)"}} </h4>
                    <h4>Total Pembayaran : Rp.{{$total}}</h4>
                </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <label for="email">Bukti Transfer</label>
                <input type="file" name="img" class="form-control">
                <br>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3"></div>
            <div class="col-md-5">
            <input type="submit" value="Konfirmasi" style="width: 100%;" class="btn btn-success">
        </div>
        </div>
    </form>
</div>
@endsection