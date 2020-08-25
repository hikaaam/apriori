<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Daftar Product</h1>
    @foreach ($data as $item)
        <a href="{{ url('product', [$item->id]) }}"> {{$item->nama_barang}} </a>
        <br>
    @endforeach
    <br>
    <h1>Cart</h1>
    @foreach ($cart as $item)
       
        <form action="{{ url('product', [$item->id_transaksi]) }}" method="post">
            @csrf
            @method("PUT")
            <a href="{{ url('product', [$item->id_barang]) }}"> {{$item->nama_barang}} </a>
            <input type="hidden" name="id" value="{{$item->id_barang}}">
            <input style="color:red;font-weight: bold;background-color: white;margin-left: 10px" type="submit" value="X">
        </form>
        <br>
    @endforeach
    <form action="{{ url('product', [$item->id_transaksi]) }}" method="post">
        @csrf
        @method("PUT")
        <input type="hidden" name="update" value="{{$item->id_barang}}">
        <input type="submit" value="Beli Barang">
    </form>
</body>
</html>