{{-- resources/views/admin/kategori/kategori-tambah.blade.php --}}

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
            <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
        </ol>
    </nav>
    
    <hr>
    <h2>Tambah Kategori</h2>
    <div class="col-12 col-md-6">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div>
                <label for="kategori">Nama</label>
                <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori"
                    class="form-control" required>
            </div>
            <div class="mt-2">
                <button class="btn btn-success" type="submit">Tambah</button>
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

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection