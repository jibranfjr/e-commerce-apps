{{-- resources/views/produk.blade.php --}}
    
@extends('layouts.app')
@include('partials.navbar')
@section('content')

<!-- banner -->
<div class="container-fluid bannerproduk d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center">Products</h1>
    </div>
</div>


<!-- body -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 bg-light sidebar-kategori">
            <h3 class="font-custom mb-3 mt-2">Kategori</h3>
            <ul class="list-group">
                @foreach($kategori as $kat)
                <a href="{{ route('produk.index', ['kategori' => $kat->nama]) }}" class="no-decoration">
                    <li class="list-group-item font-custom">{{ $kat->nama }}</li>
                </a>
                @endforeach
            </ul>
        </div>

        <div class="col-lg-9">
            <h3 class="text-center mb-3 font-custom">Products</h3>
            <div class="row">
                @if($produk->isEmpty())
                    <h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>
                @else
                    @foreach($produk as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="{{ asset('image/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title font-custom">{{ $item->nama }}</h4>
                                <p class="card-text font-custom text-mute">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('produk.show', $item->nama) }}" class="btn warna2 button-click text-white font-custom text-efek">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection