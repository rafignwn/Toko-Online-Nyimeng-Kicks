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
                  <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
              </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-shopping-cart"></i> Check Out</h1>  
                @if (!empty($pesanan))
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
                                    <td><strong>Aksi</strong></td>
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
                                        <td>
                                            <form action="{{ url('check-out') }}/{{ $item->id }}" method="post" id="form-hapus-pesanan-{{ $item->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" data-id = "{{ $item->id }}" id="tombol-hapus"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pull-right"><strong>Total Harga : </strong></td>
                                    <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                    <td><a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success" id="tombol-check-out"><i class="fa fa-shopping-cart"></i> Check Out</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
