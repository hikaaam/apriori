<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
</head>

<body>
    <h1>
        <a style="color:navy" href="{{ url('', []) }}">{{"<== "}}Back</a>
    </h1>
    <h1>{{$product->nama_barang}}</h1>
    <p>
        harga : {{$product->harga}}
    </p>
 
    <button onclick="goTo('{{ url('product/'.$product->id.'/edit', []) }}')">
        Tambahkan ke keranjang
    </button>
    <br>
    <br>
    Barang yang direkomendasikan oleh user lain :
    @php
    $i = 1;
    @endphp
    @foreach ($data as $item)
    <a href="{{ url('product', [$item->id]) }}"> {{$item->nama_barang}} </a>
    @if ($i<count($data)) ,
    @endif 
    @php $i++;
    @endphp 
    @endforeach 
    
<script>
    function goTo(url){
        window.location.replace(url);
    }
</script>
    
</body>

</html>