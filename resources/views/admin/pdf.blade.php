<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Detail Pesanan</h1>
    Nama Peminjam : <h4>{{ $pesanan->name }}</h4>
    NIK Peminjam : <h4>{{ $pesanan->nik }}</h4>
    Email Peminjam : <h4>{{ $pesanan->email }}</h4>
    Alamat Peminjam : <h4>{{ $pesanan->alamat }}</h4>
    No Telphone Peminjam : <h4>{{ $pesanan->phone }}</h4>
    <br>
    <img src="product/{{ $pesanan->image }}" height="250" width="300">
    <br><br>
    ID Skuter : <h3>{{ $pesanan->id_skuter }}</h3>
    Harga : <h3>{{ $pesanan->harga }}/Jam</h3>
    Jenis Skuter : <h3>{{ $pesanan->jenis }}</h3>
    Jumlah Skuter : <h3>{{ $pesanan->stock }}</h3>
    Tanggal pemesanan : <h3>{{ $pesanan->created_at }}</h3>
    Tanggal Pengembalian : <h3>{{ $pesanan->updated_at }}</h3>
    Status Pembayaran : <h3>{{ $pesanan->status_pembayaran }}</h3>
</body>
</html>