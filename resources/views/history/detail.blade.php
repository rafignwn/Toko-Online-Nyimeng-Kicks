@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('riwayat-pembayaran') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('riwayat-pembayaran') }}">Riwayat Pembayaran</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran</li>
                </ol>
              </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h1>Success Check Out</h1>
                </div>
                <div class="col-md-12">
                    <p>Pesanan anda berhasil di check out, selanjutnya untuk pembayaran silahkan transfer di rekening <strong>Bank Permata nomor rekening : <br> 
                    123-069-6990</strong>, dengan nominal : <strong>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-shopping-cart"></i>Detail Pembayaran</h1>
                </div>
                <div class="col-md-12">
                    <h5 class="pull-right">Tanggal : {{ $pesanan->tanggal }}</h5>
                </div>
                <div class="col-md-12 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td><strong>No</strong></td>
                                <td><strong>Nama Barang</strong></td>
                                <td><strong>Gambar</strong></td>
                                <td><strong>Jumlah</strong></td>
                                <td><strong>Harga</strong></td>
                                <td><strong>Total Harga</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td><img src="{{ url('uploads') }}/{{ $item->barang->gambar }}" alt="gambar produk" width="100"></td>
                                    <td>{{ $item->jumlah }} Pasang</td>
                                    <td>Rp. {{ number_format($item->barang->harga) }}</td>
                                    <td>Rp. {{ number_format($item->jumlah_harga) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="pull-right"><strong>Total Harga : </strong></td>
                                <td><strong>Rp. {{ number_format($pesanan->jumlah_harga + $pesanan->kode) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
