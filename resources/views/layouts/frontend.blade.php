<!DOCTYPE html>
<html lang="en">
@php
use Illuminate\Support\Facades\DB;
use App\frontend;
use App\akun;
if(Session::has('nama')){
    $akun = akun::where('email',Session::get('email'))->get();
    $user_id = $akun[0]['id'];
}
else{
    $user_id=0;
}
$cart = DB::select("SELECT t.nama_barang as nama_barang, t.id_barang as id_barang, t.id_transaksi as id_transaksi,
p.harga as harga, p.img as img FROM transactions as t INNER JOIN products as p ON p.id = t.id_barang WHERE t.status =
0 AND t.id_user = $user_id");
$view = frontend::find(1);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{config('app.name')}} </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js"
        integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
    <style>
        body {
            overflow-x: hidden;

        }
        label{
            font-size: 1em;
            font-weight: bold;
        }
        #btn-login{
            width: 45%;
            margin-right: 8%;
        }
        #btn-register{
            width: 45%;
            color: white;

        }
        .container {
            padding: 2rem 0rem;
        }

        .table-image {

            thead {

                td,
                th {
                    border: 0;
                    color: #666;
                    font-size: 0.8rem;
                }
            }

            td,
            th {
                vertical-align: middle;
                text-align: center;

                &.qty {
                    max-width: 2rem;
                }
            }
        }

        .price {
            margin-left: 1rem;
        }

        .modal-footer {
            padding-top: 0rem;
        }

        .fh5co-bg {
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            position: relative;
        }

        .footer_text {
            color: #fff;
            /* warna */
        }

        .fh5co-bg {
            background-size: cover;
            background-position: center center;
            position: relative;
            width: 100%;
            float: left;
        }

        .fh5co-bg .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            /* warna */
            -webkit-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
        }

        .fh5co-bg-section {
            background: rgba(0, 0, 0, 0.05);
            /* warna */
        }

        #fh5co-footer {
            padding: 7em 0;
            clear: both;
        }

        @media screen and (max-width: 768px) {
            #fh5co-footer {
                padding: 3em 0;
            }
        }

        #fh5co-footer {
            position: relative;
        }

        #fh5co-footer .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            -webkit-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
        }

        #fh5co-footer h3 {
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
            /* warna */
        }

        #fh5co-footer .fh5co-footer-links {
            padding: 0;
            margin: 0;
        }

        #fh5co-footer .fh5co-footer-links li {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        #fh5co-footer .fh5co-footer-links li a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
        }

        #fh5co-footer .fh5co-footer-links li a:hover {
            text-decoration: underline;
        }

        #fh5co-footer .fh5co-widget {
            margin-bottom: 30px;
        }

        @media screen and (max-width: 768px) {
            #fh5co-footer .fh5co-widget {
                text-align: left;
            }
        }

        #fh5co-footer .fh5co-widget h3 {
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        #fh5co-footer .copyright .block {
            display: block;
            color: #fff;
            /* warna */
        }


        .btn-primary {
            background: #F85A16;
            /* warna */
            color: #fff;
            /* warna */
            border: 2px solid #F85A16;
            /* warna */
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background: #f96c2f !important;
            /* warna */
            border-color: #f96c2f !important;
            /* warna */
        }

        .btn-primary.btn-outline {
            background: transparent;
            color: #F85A16;
            /* warna */
            border: 1px solid #F85A16;
            /* warna */
        }

        .btn-primary.btn-outline:hover,
        .btn-primary.btn-outline:focus,
        .btn-primary.btn-outline:active {
            background: #F85A16;
            /* warna */
            color: #fff;
            /* warna */
        }

        #text {
            color: black;
            font-size: 1rem;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a id="logo" class="navbar-brand" href="{{ url('/', []) }}">{{$view->logo}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li> --}}
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <button type="button" style="margin-right: 1em;" class="btn btn-success" data-toggle="modal"
                    data-target="#cartModal">
                    <i style="font-size:20px;" class="fa fa-shopping-cart"></i>
                </button>
                <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Your Shopping Cart
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-image">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Nama Product</th>
                                            <th scope="col">Harga</th>
                                            {{-- <th scope="col">Qty</th>
                <th scope="col">Total</th> --}}
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total = 0;
                                        $i =0;
                                        @endphp
                                        @foreach ($cart as $item)
                                        @if ($i==0)             
                                               <form action="{{ url('product', [$item->id_transaksi]) }}"
                                                method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="id" value="{{$item->id_barang}}">
                                                <input type="hidden" name="link" value="{{$_SERVER['REQUEST_URI']}}">
                                                <input class="btn btn-danger" type="hidden" value="delete">
                                            </form>
                                        @endif
                                    
                                        <tr>
                                            <td class="w-25">
                                                <a href="{{ url('product', [$item->id_barang]) }}">
                                                    <img src="{{$item->img}}" class="img-fluid img-thumbnail"
                                                        alt="{{$item->nama_barang}}">
                                                </a>
                                            </td>
                                            <td>{{$item->nama_barang}}</td>
                                            <td>{{$item->harga}}</td>
                                            {{-- <td class="qty"><input type="text" class="form-control" id="input1" value="2"></td>
                <td>178$</td> --}} @php $total = $total+intval($item->harga); @endphp

                                            <td>
                                                <form action="{{ url('product', [$item->id_transaksi]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="id" value="{{$item->id_barang}}">
                                                    <input type="hidden" name="link" value="{{$_SERVER['REQUEST_URI']}}">
                                                    <input class="btn btn-danger" type="submit" value="delete">
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                        <br>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <h5>Total: <span class="price text-success">Rp.{{$total}}</span></h5>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                @php
                                    if(Session::has('nama')){
                                        $id_trans = $item->id_transaksi;
                                    }
                                    else{
                                        $id_trans = 0;
                                    }
                                @endphp
                                <form action="{{ url('product', [$id_trans]) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <input type="hidden" name="update" value="update">
                                    <input class="btn btn-success"
                                        type="@if(count($cart)==0){{'hidden'}}@else{{'submit'}}@endif"
                                        value="Beli Barang">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                @if (Session::has('nama'))
                    <a style="color:red" href="{{ url('akun/logout', []) }}"> <i style="font-size:20px;margin-left:10px;" class="fa fa-power-off"></i></a>
                @else
                <a style="color:green;" href="{{ url('akun', []) }}"><i style="font-size:20px;margin-left:10px;" class="fa fa-sign-in"></i></a>
                @endif
            </div>
        </div>
    </nav>
    <div style="    padding-right: 1em;
    padding-left: 1em;">
        @yield('content')
    </div>


    <footer id="fh5co-footer" class="fh5co-bg" role="contentinfo">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h3>A Little About {{$view->logo}} </h3>
                    <p class="footer_text">{{$view->tentang}}. </p>
                    {{-- <p class="footer_text"><a class="btn btn-primary" href="#">Button</a></p> --}}
                </div>
                <div class="col-md-8">
                    <h3>Social Media</h3>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <ul class="fh5co-footer-links">
                            <li>
                                <a style="font-size: 1.8em;color:#eee;padding:5%" href="{{$view->github}}"><i class="fa fa-github"></i></a>
                                <a style="font-size: 1.8em;color:#eee;padding:5%" href="{{$view->facebook}}"><i class="fa fa-facebook"></i></a>
                                <a style="font-size: 1.8em;color:#eee;padding:5%" href="{{$view->instagram}}"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2020 | All Rights Reserved.</small>
                        <small class="block">Copyright by : {{$view->copyright}} </small>
                    </p>
                </div>
            </div>

        </div>
    </footer>

    @if(session()->has('modal'))
    <script>
        $(document).ready(function() {  
        $('#cartModal').modal('show');
        });
    </script>
    @endif


    <script>
        function goTo(url){
        window.location.replace(url);
    }
    </script>

</body>

</html>