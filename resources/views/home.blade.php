@extends('layouts.app')

@section('content')
@include('sweet::alert')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-12 mb-5">
            <img src="{{ url('img/logobaru.png') }}" class="rounded mx-auto d-block" alt="Logo Toko" width="500">
            <hr>
        </div>
        @foreach ($items as $item)
            <div class="col-md-4 my-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ url('uploads') }}/{{ $item->gambar }}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->nama_barang }}</h5>
                      <p class="card-text">
                          <p><strong>Harga : </strong>Rp. {{ number_format($item->harga) }} <br>
                             <strong>Stok : </strong>{{ $item->stok }}</p>
                          <hr>
                          <p><strong>Keterangan : </strong></p>
                          <div style="height: 80px">
                            <p>{{ $item->keterangan }}</p>
                          </div>
                      </p>
                      <a href="{{ url('pesan') }}/{{ $item->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
