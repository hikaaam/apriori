@extends('layouts.frontend')
@section('content')
<div class="container">
   
    <form action="{{ url('akun', []) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
                <br>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
                <br>
                @if($errors->any())
                <h6 style="color:red;">{{$errors->first()}}</h6>   
                @endif
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <input type="submit" value="Login" id="btn-login" class="btn btn-success">
                <a href="{{ url('akun/register', []) }}" class="btn btn-success" id="btn-register">Register</a>
            </div>
          
        </div>
    </form>
</div>
@endsection