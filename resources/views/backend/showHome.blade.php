@extends('layouts.backend')
@section('content')

<form action="{{ url('admin', []) }}" method="POST">
    @csrf
    <div class="row" style="width: 100%;padding-left:3%;">
        <h3 style="font-weight: bold;font-size: 1.5em;text-decoration: underline 2px;" class="col-sm-12">Setting >
            Tampilan home<br><br></h3>
        <div class="col-sm-7">
            <label for="logo">Nama Logo</label>
            <br>
            <input required type="text" name="logo" class="form-control" value="{{$data->logo}}">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="pagination">Jumlah Pagination</label>
            <br>
            <input required type="number" name="pagination" class="form-control" value="{{$data->pagination}}">
        </div>
        <div class="col-sm-7">
            <br>
            <br>
            <input style="width:100%;text-align: center" class="btn btn-success" type="submit" value="update tampilan">
        </div>
    </div>
</form>
@endsection