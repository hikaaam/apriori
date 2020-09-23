@extends('layouts.backend')
@section('content')

<form action="{{ url('admin/transaction', [$item->id_transaksi]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row" style="width: 100%;padding-left:3%;">
        <h3 style="font-weight: bold;font-size: 1.5em;text-decoration: underline 2px;" class="col-sm-12">Transaction >
            Edit Transaction<br><br></h3>
        <div class="col-sm-7">
            <label for="tentang">Status</label>
            <br>
            <select class="form-control" name="status" id="">
                <option @if("0" == $item->status){{'selected="selected"'}}@endif value="0">Baru</option>
                <option @if("2" == $item->status){{'selected="selected"'}}@endif value="2">Belum Konfirmasi</option>  
                <option @if("1" == $item->status){{'selected="selected"'}}@endif value="1">Sudah Konfirmasi</option>
               
            </select>
            <br>
        </div>

        <div class="col-sm-7">
            <br>
            <input style="width:100%;text-align: center" class="btn btn-success" type="submit" value="update status">
            <br>
            <br>
        </div>
    </div>
</form>
@endsection