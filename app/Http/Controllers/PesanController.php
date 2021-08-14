<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Pesanan;
use App\Detailpesanan;
use Alert;
use Auth;
use Carbon\Carbon;

class PesanController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $item = Barang::where('id', $id)->first();
        return view('pesan.index', compact('item'));
    }

    public function pesan(Request $request, $id){
        $item = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        // cek ketersediaan stok barang
        if ($item->stok > $request->jumlah_pesanan){
            // cek pesanan sudah pernah di buat apa belum oleh user
            $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

            if (empty($cek_pesanan)){
                $pesanan_baru = new Pesanan;
                $pesanan_baru->user_id = Auth::user()->id;
                $pesanan_baru->tanggal = $tanggal;
                $pesanan_baru->jumlah_harga = 0;
                $pesanan_baru->status = 0;
                $pesanan_baru->kode = 0;
                $pesanan_baru->save();
            }

            // mengambil id pesanan
            $id_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            $id_pesanan = $id_pesanan->id;

            // cek detail pesanan
            $cek_detail_pesanan = Detailpesanan::where('barang_id', $item->id)->where('pesanan_id', $id_pesanan)->first();
            if (empty($cek_detail_pesanan)){
                // buat detail pesanan baru jika item baru ditambahkan
                $detail_pesanan = new Detailpesanan;
                $detail_pesanan->barang_id = $item->id;
                $detail_pesanan->pesanan_id = $id_pesanan;
                $detail_pesanan->jumlah = $request->jumlah_pesanan;
                $detail_pesanan->jumlah_harga = $item->harga * $request->jumlah_pesanan;
                $detail_pesanan->save();
            }else{
                // update detail pesanan jika menambah pesanan item sebelumnya
                $detail_pesanan = Detailpesanan::where('barang_id', $item->id)->where('pesanan_id', $id_pesanan)->first();
                $detail_pesanan->jumlah = $detail_pesanan->jumlah + $request->jumlah_pesanan;
                $detail_pesanan->jumlah_harga = $detail_pesanan->jumlah_harga + ($item->harga * $request->jumlah_pesanan);
                $detail_pesanan->update();
            }

            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            $pesanan->jumlah_harga = $pesanan->jumlah_harga + ($item->harga * $request->jumlah_pesanan);
            $pesanan->update();

            return redirect('check-out')->with('pesan_berhasil', 'Pesanan Berhasil Ditambahkan');
        }else{
            // jika stok tidak tersedia maka pesanan tidak bisa dilanjutkan
            return redirect('pesan/'.$item->id)->with('pesan_gagal', 'Pesanan gagal ditambahkan, Stok tidak tersedia');
        }
    }

    public function check_out(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (!empty($pesanan)){
            $items = Detailpesanan::where('pesanan_id', $pesanan->id)->get();
            return view('pesan.check_out', compact('pesanan', 'items'));
        }else{
            return view('pesan.check_out', compact('pesanan'));
        }
    }

    public function delete($id){
        $detail_pesanan = Detailpesanan::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $detail_pesanan->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $detail_pesanan->jumlah_harga;

        if ($pesanan->jumlah_harga == 0){
            $pesanan->delete();
        }else{
            $pesanan->update();
        }

        $detail_pesanan->delete();

        return redirect('check-out')->with('pesan_berhasil', 'Pesanan Berhasil Dihapus');
    }

    public function konfirmasi(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $detail_pesanans = Detailpesanan::where('pesanan_id', $pesanan->id)->get();

        if (empty(Auth::user()->nohp) || empty(Auth::user()->alamat)){
            return redirect('profile')->with('pesan_gagal', 'Silahkan lengkapi data diri anda terlebih dahulu sebelum CHECK OUT');
        }else{
            $pesanan->status = 1;
            $pesanan->kode = rand(100, 999);
            $pesanan->update();

            foreach ($detail_pesanans as $detail_pesanan){
                $barang = Barang::where('id', $detail_pesanan->barang_id)->first();
                $barang->stok = $barang->stok - $detail_pesanan->jumlah;
                $barang->update();
            }

            return redirect('riwayat-pembayaran')->with('pesan_berhasil', 'Pesanan anda sukses di CHECK OUT');
        }
    }
}
