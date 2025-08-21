{{-- resources/views/admin/kategori/kategori-detail.blade.php --}}

@extends('layouts.admin')
@include('partials.admin-navbar')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-muted no-decoration">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.kategori.index') }}" class="text-muted no-decoration">Kategori</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Detail Kategori
            </li>
        </ol>
    </nav>
    
    <hr>
    <h2>Detail Kategori</h2>
    <div class="col-12 col-md-6">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <div class='mb-2'>
                <label for="kategori">Nama</label>
                <input type="text" name="kategori" id="kategori" class="form-control mt-1" value="{{ old('kategori', $kategori->nama) }}">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>

        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline ms-auto" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
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

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection