{{-- resources/views/admin/produk/produk-tambah.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}" class="text-muted text-decoration-none">Produk</a></li>
            <li class="breadcrumb-item active">Tambah Produk</li>
        </ol>
    </nav>

    <hr>
    <h2 class="mb-4">Tambah Produk</h2>

    <div class="col-12 col-md-6">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div>
                <label for="id_kategori">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('id_kategori') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" required>
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" class="form-control" rows="5">{{ old('detail') }}</textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="Tersedia" {{ old('ketersediaan_stok') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Habis" {{ old('ketersediaan_stok') == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
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
    </div>
</div>
@endsection