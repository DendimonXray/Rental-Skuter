<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .h1_font{
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            padding-bottom: 20px;
        }
        .table_des{
            border: 2px solid white;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;

        }
        .th_des{
            background-color: skyblue;
            padding: 10px;
        }
        .img_deg{
            width: 100px;
            height: 100px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="h1_font">Semua Pesanan</h1>

                <div style="padding-left: 500px; padding-bottom: 30px;">
                    <form action="{{ url('search') }}" method="GET">
                        @csrf
                        <input type="text" style="color: black" name="search" placeholder="Masukan Id Skuter">

                        <input type="submit" value="search" class="btn btn-info">
                    </form>
                </div>

                <table class="table_des">
                    <tr>
                        <th class="th_des">Name</th>
                        <th class="th_des">NIK</th>
                        <th class="th_des">Email</th>
                        <th class="th_des">Phone</th>
                        <th class="th_des">Alamat</th>
                        <th class="th_des">Id Skuter</th>
                        <th class="th_des">Jam</th>
                        <th class="th_des">Jenis</th>
                        <th class="th_des">Jumlah</th>
                        <th class="th_des">Status Pembayaran</th>
                        <th class="th_des">Status Peminjaman</th>
                        <th class="th_des">Total</th>
                        <th class="th_des">Image</th>
                        <th class="th_des">Action</th>
                        <th class="th_des">Print</th>
                    </tr>
                    @forelse ($pesanan as $pesanan)
                        
                    <tr>
                        <td> {{ $pesanan->name }} </td>
                        <td> {{ $pesanan->nik }} </td>
                        <td> {{ $pesanan->email }} </td>
                        <td> {{ $pesanan->phone }} </td>
                        <td> {{ $pesanan->alamat }} </td>
                        <td> {{ $pesanan->id_skuter }} </td>
                        <td> {{ $pesanan->jam }} </td>
                        <td> {{ $pesanan->jenis }} </td>
                        <td> {{ $pesanan->stock }} </td>
                        <td> {{ $pesanan->status_pembayaran }} </td>
                        <td> {{ $pesanan->status_peminjaman }} </td>
                        <td> {{ $pesanan->total }} </td>
                        <td>
                            <img class="img_deg" src="/product/{{ $pesanan->image }}" >
                        </td>
                        <td>
                        @if ($pesanan->status_peminjaman=="Menunggu Pembayaran")
                        <a onclick="return confirm('Anda Yakin Skuter ini Sudah diBayar? ')" href="{{ url('dibayar',$pesanan->id) }}" class="btn btn-primary">Bayar</a>
                        @elseif ($pesanan->status_peminjaman=="Dipinjamkan")
                        <a onclick="return confirm('Anda Yakin Skuter ini Sudah diKembalikan? ')" href="{{ url('selesaikan',$pesanan->id) }}" class="btn btn-warning">Selesai</a>
                        @else
                        <p style="color: red">Selesai</p>
                        @endif
                        </td>
                        <td>
                            <a href="{{ url('print_pdf',$pesanan->id) }}" class="btn btn-secondary">Print</a>
                        </td>
                    </tr>
                    @empty
                    <div>
                        <tr colspan="14">
                            <td>Data Tidak Ditemukan</td>
                        </tr>
                    </div>
                    @endforelse
                </table>
            </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>