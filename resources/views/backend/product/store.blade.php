<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Product</title>
</head>

<body>
    <h1>Tambah Product</h1>
    @if(session()->has('success'))
    <div class="alert alert-success">
        <p style="color:green"> {{ session()->get('success') }}</p>
        <br>
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">
       <p  style="color:red"> {{ session()->get('error') }}</p>
        <br>
    </div>
    @endif
    <form action="{{ url('admin/product', []) }}" method="post">
        @csrf
        <label for="nama_barang">Nama Barang :</label>
        <br>
        <input autocomplete="off" type="text" required name="nama_barang">
        <br>
        <br>
        <label for="harga">Harga :</label>
        <br>
        <input autocomplete="off" type="text" required name="harga">
        <br>
        <br>
        <label for="id_kategori">Kategori :</label>
        <br>
        <select required name="id_kategori">
            @foreach ($data as $item)
            <option value="{{$item->nama_kategori}}">{{$item->nama_kategori}}</option>
            @endforeach
        </select>
        <br>
        <br>
        <input type="submit" value="Tambah Product">
    </form>
</body>

</html>