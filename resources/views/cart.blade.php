{{-- resources/views/cart.blade.php --}}

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

<div class="container mt-5 mb-5 pb-3 font-custom">
    <h1>Shopping cart</h1>
    <div style="height: 50px;"></div>

    @if($keranjang->isEmpty())
        <p>The cart is still empty.</p>
        <div style="height: 300px;"></div>
    @else
        <table class="table mb-5">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keranjang as $cart)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_carts[]" 
                                   value="{{ $cart->id }}"
                                   data-produk-id="{{ $cart->produk->id }}"
                                   data-nama="{{ $cart->produk->nama }}"
                                   data-harga="{{ $cart->produk->harga }}"
                                   data-qty="{{ $cart->quantity }}">
                        </td>
                        <td>{{ $cart->produk->nama }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn warna2 text-white button-click mb-5" data-bs-toggle="modal" data-bs-target="#formCheckoutModal">
            Checkout Selected Products
        </button>
        <div style="height: 150px;"></div>
    @endif
</div>
{{-- Include file modal checkout --}}
@include('transaksi')

@endsection
