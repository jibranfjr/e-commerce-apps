{{-- resources/views/home.blade.php --}}
    
@extends('layouts.app')
@include('partials.navbar')
@section('content')

<!-- banner -->
<div class="container-fluid banner d-flex align-items-center font-custom">
    <div class="container text-center text-white">
        <h1>Toko Permata Puri Bali</h1>
        <h3>Mau Cari Apa?</h3>
        <div class="col-md-8 offset-md-2">
            <form method="get" action="{{ url('produk') }}">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Search" name="keyword">
                    <button type="submit" class="btn warna2 magnifying-glass button-click text-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- highlight kategori -->
<div class="container-fluid py-5 font-custom">
    <div class="container text-center">
        <div class="row justify-content-center mt-3">
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-cincin-permata d-flex justify-content-center align-items-center">
                    <h4 class="text-efek">
                        <a class="no-decoration" href="{{ route('produk.index', ['kategori' => 'Cincin Permata']) }}">Cincin Permata</a>
                    </h4>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-batu-permata d-flex justify-content-center align-items-center">
                    <h4 class="text-efek">
                        <a class="no-decoration" href="{{ route('produk.index', ['kategori' => 'Batu Permata']) }}">Batu Permata</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- produk -->
<div class="container-fluid py-5 font-custom">
    <div class="container text-center">
        <h3>Products</h3>
        <hr>
        <div class="row mt-5">
            @foreach($produk as $item)
            <div class="col-sm-6 col-md-4 mb-3">
                <div class="card h-100">
                    <div class="image-box">
                        <img src="{{ asset('image/' . $item->foto) }}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $item->nama }}</h4>
                        <p class="card-text text-harga">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.show', $item->nama) }}" class="btn warna2 button-click text-white text-efek">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection