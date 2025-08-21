{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house"></i> Home
            </li>
        </ol>
    </nav>
    
    <hr>
    <h2>Selamat Datang {{ Auth::user()->username }}</h2>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-kategori p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-solid fa-layer-group fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Kategori</h3>
                            <p class="fs-5">{{ $jumlahKategori }} Kategori</p>
                            <a class="nav-link" href="{{ url('admin/kategori') }}" class="text-white text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-produk p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-solid fa-gift fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Produk</h3>
                            <p class="fs-5">{{ $jumlahProduk }} Produk</p>
                            <a class="nav-link" href="{{ url('admin/produk') }}" class="text-white text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-transaksi p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-regular fa-credit-card fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Transaksi</h3>
                            <p class="fs-5">{{ $jumlahTransaksi }} Transaksi</p>
                            <a class="nav-link" href="{{ url('admin/transaksi') }}" class="text-white text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-users p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-regular fa-user fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Users</h3>
                            <p class="fs-5">{{ $jumlahUsers }} Users</p>
                            <a class="nav-link" href="{{ url('admin/users') }}" class="text-white text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
