<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
    .center{
        margin: auto;
        width: 70%;
        border: 5px solid white;
        padding-top: 40px;
    }
    .font{
        text-align: center;
        font-size: 40px;
        padding-bottom: 20px;
    }
    .image{
        width: 100px;
        height: 100px;
        /* padding: 30px; */
    }
    .tr_color{
        background: rgb(255, 161, 88);
    }
    .td_color{
        padding: 30px;
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

                <h2 class="font"> All Variant Skuter</h2>
                <table class="center">
                    <tr class="tr_color">
                        <td class="td_color">Id Skuter</td>
                        <td class="td_color">Harga</td>
                        <td class="td_color">Status</td>
                        <td class="td_color">Jenis</td>
                        <td class="td_color">Warna</td>
                        <td class="td_color">Stock</td>
                        <td class="td_color">Image</td>
                        <td class="td_color">Delete</td>
                        <td class="td_color">Update</td>
                    </tr>
                    @foreach ($data as $data)
                        <tr >
                            <td class="td_color">{{ $data->id_skuter }}</td>
                            <td class="td_color">{{ $data->harga }}</td>
                            <td class="td_color">{{ $data->status }}</td>
                            <td class="td_color">{{ $data->jenis }}</td>
                            <td class="td_color">{{ $data->warna }}</td>
                            <td class="td_color">{{ $data->stock }}</td>
                            <td> 
                                <img src="/product/{{ $data->image }}" class="image">
                            </td>
                            <td><a onclick="return confirm('Anda Yakin Ingin Menghapus Ini?')" href="{{ url('delete_product', $data->id) }}" class="btn btn-danger ">Delete</a></td>
                            <td><a href="{{ url('update_product',$data->id) }}" class="btn btn-primary">Update</a></td>
                        </tr>
                    @endforeach
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