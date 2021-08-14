<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Detailpesanan;
use App\Barang;
use Auth;

class HistoryController extends Controller
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
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();

        return view('history.index', compact('pesanans'));
    }

    public function detail($id){
        $pesanan = Pesanan::where('id', $id)->first();

        $items = Detailpesanan::where('pesanan_id', $pesanan->id)->get();

        return view('history.detail', compact('items',  'pesanan'));
    }
}
