{{-- resources/views/admin/transaksi-detail.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="no-print">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}" class="no-decoration text-muted">
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
    <div class="mt-3">
        <h2 class="mb-4">Detail Transaksi</h2>

        <div class="col-12 col-md-6">
            <form>
                {{-- Data User --}}
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

                {{-- Produk yang dipesan (loop) --}}
                <div class="mb-3">
                    <label class="form-label">Produk yang Dipesan</label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi->details as $detail)
                                    <tr>
                                        <td>{{ $detail->produk->nama }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>
                                        Rp {{ number_format($transaksi->details->sum(fn($d) => $d->jumlah * $d->harga), 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Bukti pembayaran --}}
                <div class="mb-3">
                    <label class="form-label">Bukti Pembayaran</label><br>
                    <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" width="120px">
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tombol Konfirmasi --}}
    @if($transaksi->status !== 'Konfirmasi Pemesanan')
        <form action="{{ route('admin.transaksi.konfirmasi', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengkonfirmasi pesanan ini?')">
            @csrf
            @method('PUT')
            <button type="submit" class="btn warna2 button-click text-white btn-sm">
                <i class="fa fa-check"></i> Konfirmasi Pesanan
            </button>
        </form>
    @else
        <button type="submit" class="btn btn-success btn-sm mb-2 mt-1" disabled>Sudah Dikonfirmasi</button>
    @endif 

    {{-- Tombol Hapus --}}
    <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
    </form>
</div>
@endsection
