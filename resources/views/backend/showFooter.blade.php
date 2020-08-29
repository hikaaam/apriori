@extends('layouts.backend')
@section('content')

<form action="{{ url('admin', []) }}" method="POST">
    @csrf
    <div class="row" style="width: 100%;padding-left:3%;">
        <h3 style="font-weight: bold;font-size: 1.5em;text-decoration: underline 2px;" class="col-sm-12">Setting >
            Tampilan footer<br><br></h3>
        <div class="col-sm-7">
            <label for="tentang">Tentang</label>
            <br>
            <textarea required type="text" name="tentang" class="form-control">{{$data->tentang}}</textarea>
            <br>
        </div>
        <div class="col-sm-7">
            <label for="copyright">Copyright</label>
            <br>
            <input required type="text" name="copyright" class="form-control" value="{{$data->copyright}}">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="facebook">Facebook</label>
            <br>
            <input required type="text" name="facebook" class="form-control" value="{{$data->facebook}}">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="instagram">Instagram</label>
            <br>
            <input required type="text" name="instagram" class="form-control" value="{{$data->instagram}}">
            <br>
        </div>
        <div class="col-sm-7">
            <label for="github">Github</label>
            <br>
            <input required type="text" name="github" class="form-control" value="{{$data->github}}">
            <br>
        </div>
        <div class="col-sm-7">
            <br>
            <input style="width:100%;text-align: center" class="btn btn-success" type="submit" value="update tampilan">
            <br>
            <br>
        </div>
    </div>
</form>
@endsection