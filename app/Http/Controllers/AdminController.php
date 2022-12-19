<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use Illuminate\Http\Request;
use App\Models\Skuter;
use App\Models\Product;
use PDF;

class AdminController extends Controller
{
    public function view_catagory(){
        $data = Skuter::all();
        return view('admin.catagory', compact('data'));
    }
    public function add_skuter(Request $request){
        $data = new skuter;
        $data->skuter_name = $request->skuter;
        $data->save();
        return redirect()->back()->with('message', 'Jenis Skuter Berhasil Ditambahkan');
    }

    public function delete_skuter($id){
        $data=Skuter::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Jenis Skuter Berhasil Dihapus');

    }

    public function view_product(){
        $nama = Skuter::all();
        return view('admin.product', compact('nama'));
    }

    public function add_product(Request $request){
        $product = new Product;
        $product->id_skuter = $request->id;
        $product->harga = $request->harga;
        $product->status = $request->status;
        $product->jenis = $request->jenis;
        $product->warna = $request->warna;
        $product->stock = $request->stock;

        // menyimpan imgae
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();
        return redirect()->back()->with('message', 'Skuter Berhasil Ditambahkan');
    }

    public function show_product(){
        $data = Product::all();
        return view('admin.show', compact('data'));
    }

    public function delete_product($id){
        $data=Product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Skuter Berhasil Dihapus');

    }

    public function update_product($id){
        $product=Product::find($id);
        $nama = Product::all();
        return view('admin.update', compact('product','nama'));
    }

    public function update_product_skuter(Request $request ,$id){
        $product = Product::find($id);
        $product->id_skuter = $request->id;
        $product->harga = $request->harga;
        $product->status = $request->status;
        $product->jenis = $request->jenis;
        $product->warna = $request->warna;
        $product->stock = $request->stock;

        $image = $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->with('message', 'Skuter Berhasil Diupdate');
    }

    public function pesanan(){
        $pesanan = pembayaran::all();

        return view('admin.pesanan', compact('pesanan'));
    }

    public function dibayar(Request $request ,$id){
        $data = pembayaran::find($id);
        $data->status_pembayaran = "Dibayar";
        $data->status_peminjaman = "Dipinjamkan";
        $data->save();
        return redirect()->back();
    }
    public function selesaikan(Request $request ,$id){
        $data = pembayaran::find($id);
        $data->status_peminjaman = "Dikembalikan";
        $data->save();
        return redirect()->back();
    }

    public function print_pdf($id){
        $pesanan = pembayaran::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('pesanan'));
        return $pdf->download('detail_pesanan.pdf');
    }

    public function searchskuter(Request $request){
        $data = $request->search;

        $pesanan = pembayaran::where('name','LIKE',"%$data%")
        ->orwhere('nik','LIKE','%$data%')
        ->orwhere('jenis','LIKE','%$data%')
        ->orwhere('id_skuter','LIKE','%$data%')
        ->orwhere('email','LIKE','%$data%')
        ->orwhere('phone','LIKE','%$data%')
        ->orwhere('status_pembayaran','LIKE','%$data%')
        ->orwhere('status_peminjaman','LIKE','%$data%')->get();

        return view('admin.pesanan', compact('pesanan'));
    }
    
}
