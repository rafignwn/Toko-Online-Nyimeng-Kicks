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
                  <li class="breadcrumb-item active" aria-current="page">History Pembayaran</li>
                </ol>
              </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-history"></i> History Pembayaran</h1>  
                @if (!empty($pesanans))
                </div>
                    <div class="col-md-12 mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td><strong>No</strong></td>
                                    <td><strong>Tanggal</strong></td>
                                    <td><strong>Status</strong></td>
                                    <td><strong>Jumlah Harga</strong></td>
                                    <td><strong>Aksi</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pesanan->tanggal}}</td>
                                        <td>
                                            
                                            @if ($pesanan->status == 1)
                                                <p>Sudah pesan & Belum bayar</p> 
                                            @else
                                                <p>Sudah Bayar</p>
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($pesanan->jumlah_harga) }}</td>
                                        <td><a href="{{ url('detail-pembayaran') }}/{{ $pesanan->id }}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
