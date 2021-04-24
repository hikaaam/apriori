@extends('layouts.frontend')
@section('content')
    <div class="container">
        <form action="{{ url('akun', []) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label for="email">Nama</label>
                    <input type="text" name="nama" required class="form-control">
                    <br>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label for="email">Alamat</label>
                    <textarea type="text" name="alamat" required class="form-control"></textarea>
                    <br>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label for="email">Email</label>
                    <input type="email" name="email" required class="form-control">
                    <br>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label for="password">Password</label>
                    <input type="password" name="password" required class="form-control">
                    <br>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <input type="submit" value="Register" style="width: 100%;" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
@endsection
