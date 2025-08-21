{{-- resources/views/admin/produk/produk-detail.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}" class="text-muted text-decoration-none">Produk</a></li>
            <li class="breadcrumb-item active">Detail Produk</li>
        </ol>
    </nav>
    
    <hr>
    <h2>Detail Produk</h2>
    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="{{ $produk->kategori->id }}">{{ $produk->kategori->nama }}</option>
                @foreach($kategoriLain as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Foto Produk Saat Ini</label><br>
            <img src="{{ asset('image/' . $produk->foto) }}" width="100px">
        </div>

        <div class="mb-3">
            <label for="foto">Upload Foto Baru</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label for="detail">Detail</label>
            <textarea name="detail" rows="5" class="form-control">{{ old('detail', $produk->detail) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ketersediaan_stok">Ketersediaan Stok</label>
            <select name="ketersediaan_stok" class="form-control">
                <option value="Tersedia" {{ $produk->ketersediaan_stok == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Habis" {{ $produk->ketersediaan_stok == 'Habis' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mb-2">Simpan</button>
    </form>

    <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline ms-auto" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mb-2" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</button>
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
@endsection