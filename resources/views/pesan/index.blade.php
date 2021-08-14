@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $item->nama_barang }}</li>
                </ol>
              </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ url('uploads') }}/{{ $item->gambar }}" class="img-fluid" alt="Gambar Produk" width="500">
                </div>
                <div class="col-md-6">
                    <h2 class="my-4">{{ $item->nama_barang }}</h2>
                    <table class="table table">
                        <tbody>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>:</td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stok</strong></td>
                                <td>:</td>
                                <td>{{ $item->stok }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>:</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah</strong></td>
                                <td>:</td>
                                <td>
                                    <form action="{{ url('pesan') }}/{{ $item->id }}" method="post">
                                    @csrf
                                        <input type="number" class="form-control" name="jumlah_pesanan">
                                        <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-shopping-cart"></i> Masukan keranjang</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
