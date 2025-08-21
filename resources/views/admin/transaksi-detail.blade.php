{{-- resources/views/admin/transaksi-detail.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('title', 'Data Transaksi')

@section('content')
<div class="container mt-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="no-print">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/adminpanel') }}" class="no-decoration text-muted">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.transaksi.index') }}" class="no-decoration text-muted">
                    Transaksi
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
        </ol>
    </nav>
    
    <hr>
    {{-- Area yang akan dicetak --}}
    <div class="mt-3" id="print-area">
        <h2 class="mb-4">Detail Transaksi</h2>

        <div class="col-12 col-md-6">
            <form>
                <div class="mb-3">
                    <label class="form-label">Produk Yang Dipesan</label>
                    <input type="text" class="form-control" value="{{ $transaksi->produk->nama }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Yang Dipesan</label>
                    <input type="text" class="form-control" value="{{ $transaksi->jumlah }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $transaksi->user->username }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" value="{{ $transaksi->alamat }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank</label>
                    <input type="text" class="form-control" value="{{ $transaksi->bank }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{ $transaksi->nomor_rekening }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pemilik Rekening</label>
                    <input type="text" class="form-control" value="{{ $transaksi->nama_rekening }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bukti Pembayaran</label><br>
                    <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" width="100px">
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tombol Konfirmasi Pesanan --}}
    @if($transaksi->status !== 'Konfirmasi Pemesanan')
        <form action="{{ route('admin.transaksi.konfirmasi', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengkonfirmasi pesanan ini?')">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-check"></i> Konfirmasi Pesanan
            </button>
        </form>
    @else
        <button type="submit" class="btn btn-success btn-sm mb-2 mt-1" disabled>Sudah Dikonfirmasi</button>
    @endif 

    <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</button>
    </form>
    
    {{-- Tombol Cetak --}}
    <div class="mt-2 mb-3 no-print">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fa fa-print"></i> Cetak
        </button>
    </div>

    
</div>

{{-- CSS untuk cetak --}}
<style>
    @media print {
        .no-print,
        nav,
        .breadcrumb {
            display: none !important;
        }

        #print-area {
            margin-top: 0;
            padding-top: 0;
        }
    }
</style>
@endsection