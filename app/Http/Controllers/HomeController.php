<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Product;
use App\Models\transaksi;
use App\Models\pembayaran;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data = Product::paginate(6);
        return view('home.userpage',compact('data'));
    }
    public function redirect(){
        $usertype=Auth::user()->usertype;

        if($usertype=='1'){
            $total_skuter = Product::all()->count();
            $total_pesanan = transaksi::all()->count();
            $total_member = User::all()->count();
            $pemasukan = pembayaran::all();
            $totals = 0;
            foreach($pemasukan as $pemasukan){
                $totals = $totals + $pemasukan->total;
            }
            $peminjaman = pembayaran::where('status_peminjaman', '=', 'Dipinjamkan')->get()->count();
            $kembali = pembayaran::where('status_peminjaman', '=', 'Dikembalikan')->get()->count();
            $belum = pembayaran::where('status_peminjaman', '=', 'Menunggu Pembayaran')->get()->count();
            return view('admin.home', compact('total_skuter','total_pesanan','total_member','totals','peminjaman','kembali','belum'));
        }else{
            $data = Product::paginate(3);
            return view('home.userpage',compact('data'));
        }
    }

    public function skuter_details($id){

        $data = Product::find($id);
        return view('home.skuter_details',compact('data'));
    }

    public function pesan_skuter(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product = product::find($id);

            $transaksi = new transaksi;

            // bagian member
            $transaksi->name=$user->name;
            $transaksi->nik=$user->nik;
            $transaksi->email=$user->email;
            $transaksi->phone=$user->phone;
            $transaksi->alamat=$user->alamat;
            $transaksi->user_id=$user->id;

            // bagian skuter
            $transaksi->id_skuter=$product->id_skuter;
            $transaksi->product_id=$product->id;
            $transaksi->harga=$product->harga * $request->jumlah;
            $transaksi->jam=$request->jam;
            $transaksi->stock=$request->jumlah;
            $transaksi->jenis=$product->jenis;
            $transaksi->total=$product->harga * $request->jumlah * $request->jam;
            $transaksi->image=$product->image;

            $transaksi->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function show_keranjang(){

        if(Auth::id()){
            $id = Auth::user()->id;
    
            $keranjang = transaksi::where('user_id','=',$id)->get();
            return view('home.keranjang',compact('keranjang'));
        }else{
            return redirect('login');
        }
    }

    public function hapus_keranjang($id){
        $data = transaksi::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function bayar_ditempat(){
        $user = Auth::user();
        $userid = $user->id;
        $data = transaksi::where('user_id', '=', $userid)->get();

        foreach($data as $data){
            $pembayaran = new pembayaran;
            $pembayaran->name = $data->name;
            $pembayaran->nik = $data->nik;
            $pembayaran->email = $data->email;
            $pembayaran->phone = $data->phone;
            $pembayaran->alamat = $data->alamat;
            $pembayaran->user_id = $data->user_id;

            $pembayaran->product_id = $data->product_id;
            $pembayaran->id_skuter = $data->id_skuter;
            $pembayaran->harga = $data->harga;
            $pembayaran->jam = $data->jam;
            $pembayaran->total = $data->total;
            $pembayaran->jenis = $data->jenis;
            $pembayaran->stock = $data->stock;
            $pembayaran->image = $data->image;

            $pembayaran->status_pembayaran = 'Belum Dibayar';
            $pembayaran->status_peminjaman = 'Menunggu Pembayaran';

            $pembayaran->save();

            $skuter_id = $data->id;
            $skuter = transaksi::find($skuter_id);
            $skuter->delete();

        }
        return redirect()->back()->with('message','Pesanan Anda Diterima, Mohon Segera Selesaikan Pembayaran Anda!');
    }

    public function show_pesanan(){
        $user = Auth::user();
        $userid = $user->id;

        $riwayat = pembayaran::where('user_id', '=', $userid)->get();
        return view('home.riwayat', compact('riwayat'));
    }

    public function cari_skuter(Request $request){
        $cari_s = $request->cari;
        $data = Product::where('jenis', 'LIKE', "%$cari_s%")
        ->orwhere('id_skuter', 'LIKE', "%$cari_s%")
        ->orwhere('warna', 'LIKE', "%$cari_s%")->paginate(6);
        return view('home.userpage', compact('data'));
    }
}
