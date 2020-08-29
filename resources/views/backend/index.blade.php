@extends('layouts.backend')
@section('content')
<div class="row" style="padding-left:3%;padding-right: 5%;">
    <div class="col-sm-4">
        <div class="card">
           <div style="font-size: 13em;color:#2e2e2c;">
            <div style="padding: 2%;" class="d-flex justify-content-center">
                <i class="fa fa-shopping-cart"></i>
            </div>               
           </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 style="font-weight: bold;font-size: 1.5em;" class="card-title">Barang Dibeli : {{$barang_dibeli}} </h5>
                </div> 
            </div>
        </div>   
    </div>

    <div class="col-sm-4">
        <div class="card">
           <div style="font-size: 13em;color:#2e2e2c;">
            <div style="padding: 2%;" class="d-flex justify-content-center">
                <i class="fa fa-box-open"></i>
            </div>               
           </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 style="font-weight: bold;font-size: 1.5em;" class="card-title">Jumlah Product : {{$jumlah_product}} </h5>
                </div> 
            </div>
        </div>   
    </div>

    <div class="col-sm-4">
        <div class="card">
           <div style="font-size: 13em;color:#2e2e2c;">
            <div style="padding: 2%;" class="d-flex justify-content-center">
                <i class="fa fa-handshake"></i>
            </div>               
           </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h5 style="font-weight: bold;font-size: 1.5em;#2e2e2c;" class="card-title">Jumlah Transaksi : {{$jumlah_transaksi}} </h5>
                </div> 
            </div>
        </div>   
    </div>

</div>
@endsection