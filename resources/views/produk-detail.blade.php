{{-- resources/views/produk-detail.blade.php --}}
    
@extends('layouts.app')
@include('partials.navbar')
@section('content')

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

<!-- Detail Produk -->
<div class="container-fluid py-5 font-custom">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('image/' . $produk->foto) }}" class="w-100" alt="{{ $produk->nama }}">
            </div>
            <div class="col-md-6 offset-md-1">
                <h1>{{ $produk->nama }}</h1>
                <hr>
                <p class="teks-produk-detail"><strong>Kategori: </strong>{{ $produk->kategori->nama }}</p>
                <p class="teks-produk-detail"><strong>Stok: </strong>{{ $produk->ketersediaan_stok }}</p>
                <p class="fs-5"><strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong></p>
                <p class="teks-produk-detail">{{ $produk->detail }}</p>
                <hr>
                @auth
                <div class="mb-3">
                    <label for="qty" class="form-label">Jumlah</label>
                    <input type="number" id="qty" name="qty" class="form-control" value="1" min="1" required>
                </div>
                <button type="button" class="btn warna2 button-click text-white"
                        data-bs-toggle="modal"
                        data-bs-target="#formCheckoutModal"
                        onclick="setQtyToCheckout()">
                    Beli Produk
                </button>
                @endauth
            </div>
            {{-- Include file modal checkout --}}
            @include('transaksi', ['produk' => $produk])
        </div>
    </div>
</div>

<div class="container-fluid py-5 bg-light font-custom">
    <div class="container">
        <h2 class="text-center mb-5">Produk Lainnya</h2>
        <div class="row">
            @foreach($produkTerkait as $item)
            <div class="col-lg-3 mb-3">
                <a href="{{ route('produk.show', $item->nama) }}">
                    <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid img-thumbnail produk-terkait-image" alt="{{ $item->nama }}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function setQtyToCheckout() {
        let qty = document.getElementById('qty').value;

        let checkoutQty = document.getElementById('checkout_qty');
        checkoutQty.value = qty;

        checkoutQty.setAttribute('readonly', true);

        let hargaSatuan = parseInt(document.getElementById('harga_satuan').value);
        let total = hargaSatuan * parseInt(qty);
        document.getElementById('total_harga').value = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>
@endsection