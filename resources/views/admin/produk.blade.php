{{-- resources/views/admin/produk.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('content')
<div class="container mt-5 mb-5 pb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ url('/admin') }}" class="no-decoration text-muted">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>
    
    <hr>
    <h2 class="mb-4">List Produk</h2>

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
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori->nama ?? '-' }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->ketersediaan_stok }}</td>
                            <td>
                                <a href="{{ route('admin.produk.show', $item->id) }}" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data produk tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .no-decoration {
        text-decoration: none;
    }

    .custom-header thead th {
        border-bottom: 2px solid #000;
        font-weight: bold;
    }

    .form div {
        margin-bottom: 10px;
    }
</style>
@endpush