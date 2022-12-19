<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
    .div_center{
        text-align: center;
        padding-top: 40px;
    }
    .font{
        font-size: 40px;
        padding-bottom: 40px;
    }
    .text_color{
        color: black;
        padding-bottom: 10px;
    }
    label{
        display: inline-block;
        width: 180px;
    }
    .div_design{
        padding-bottom: 15px;
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
                @if(session()->has('message'))

                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>

                @endif
                <div class="div_center">
                    <h1 class="font"> Tambah Skuter</h1>

                    <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="div_design">
                        <label>ID Skuter : </label>
                        <input type="text" class="text_color" name="id" placeholder="Masukan ID Skuter" required="">
                        </div>

                        <div class="div_design">
                        <label>Harga Skuter : </label>
                        <input type="number" class="text_color" name="harga" placeholder="Masukan Harga Skuter" required="">
                        </div>

                        <div class="div_design">
                        <label>Status Skuter : </label>
                        <select name="status" class="text_color" required="">
                            <option value="" selected="">Masukan Status Skuter</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                        </div>

                        <div class="div_design">
                        <label>Jenis Skuter : </label>
                        <select name="jenis" class="text_color" required="">
                            <option value="" selected=""> Pilih Jenis Skuter</option>
                            @foreach ($nama as $nama)
                            <option value="{{ $nama->skuter_name }}">{{ $nama->skuter_name }}</option>
                            @endforeach
                        </select>
                        </div>
                        
                        <div class="div_design">
                        <label>Warna Skuter : </label>
                        <input type="text" class="text_color" name="warna" placeholder="Masukan Warna Skuter" required="">
                        </div>

                        <div class="div_design">
                        <label>Stock Skuter : </label>
                        <input type="text" class="text_color" name="stock" placeholder="Masukan Stock Skuter" required="">
                        </div>

                        <div class="div_design">
                        <label>Gambar Skuter : </label>
                        <input type="file" name="image" required="">
                        </div>

                        <div class="div_design">
                        <input type="Submit" class="btn btn-primary" >
                        </div>

                    </form>
                </div>
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