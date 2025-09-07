{{-- resources/views/admin/transaksi.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')
@section('title', 'Data Transaksi')

@section('content')
<div class="container mt-5 mb-5 pb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}" class="text-muted text-decoration-none">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </nav>

  

    <hr>
    <h2>List Transaksi</h2>


    
        <div class="table-responsive mt-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 
            <table class="table custom-header">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Produk Yang di Pesan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->username ?? '-' }}</td>
                            
                            {{-- Tampilkan semua produk yang dipesan dalam transaksi --}}
                            <td>
                                <ul class="mb-0">
                                    @foreach ($item->details as $detail)
                                        <li>{{ $detail->produk->nama }} (x{{ $detail->jumlah }})</li>
                                    @endforeach
                                </ul>
                            </td>

                            {{-- Total jumlah barang --}}
                            <td>
                                {{ $item->details->sum('jumlah') }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($item->status == 'Pending')
                                    <form action="{{ route('admin.transaksi.konfirmasi', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn warna2 button-click text-white btn-sm">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm" disabled>Sudah Dikonfirmasi</button>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td>
                                <a href="{{ route('admin.transaksi.show', $item->id) }}" method="GET" target="_blank" class="btn warna2 button-click text-white">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ route('invoice.generate', $item->id) }}" class="btn warna2 button-click text-white btn-sm">
                                    Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Transaksi tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>
@endsection

@push('styles')
<style>
    .custom-header thead th {
        border-bottom: 2px solid #000;
        font-weight: bold;
    }
</style>
@endpush