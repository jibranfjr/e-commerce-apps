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
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                            <td>{{ $item->produk->nama ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>
                                @if($item->status == 'Pending')
                                    <form action="{{ route('admin.transaksi.konfirmasi', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm" disabled>Sudah Dikonfirmasi</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $item->id) }}" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Transaksi tidak tersedia</td>
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