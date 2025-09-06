{{-- resources/views/user.blade.php --}}

@extends('layouts.app')
@include('partials.navbar')
@section('content')

<div class="container mt-4 font-custom">

    {{-- Profil User --}}
    <div class="d-flex align-items-center bg-light p-4 rounded shadow-sm mb-4">
        <div class="me-3">
            <img src="{{ asset('image/default-profile.jpeg') }}" 
                 alt="Foto Profil" 
                 class="rounded-circle" 
                 width="80" height="80">
        </div>
        <div>
            <h4 class="mb-1">{{ Auth::user()->username }}</h4>
            <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
            <small class="text-secondary">
                Joined since {{ auth()->user()->created_at->format('d M Y') }}
            </small>
        </div>
    </div>

    {{-- Judul Halaman --}}
    <h2 class="mb-3 font-custom">My Order History</h2>

    {{-- Tabel Riwayat Pesanan --}}
    <div class="table-responsive rounded font-custom">
        <table class="table table-bordered" style="margin-bottom: 200px;">
            <thead class="table-success">
                <tr>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                    <tr>
                        {{-- Produk yang dibeli --}}
                        <td>
                            @foreach($item->details as $detail)
                                {{ $detail->produk?->nama ?? 'Produk dihapus' }} <br>
                            @endforeach
                        </td>

                        {{-- Jumlah produk --}}
                        <td>
                            @foreach($item->details as $detail)
                                {{ $detail->jumlah }} <br>
                            @endforeach
                        </td>

                        {{-- Status pesanan --}}
                        <td>
                            @if($item->status === 'Konfirmasi Pemesanan')
                                <span class="badge bg-success">Order Confirmed</span>
                            @elseif($item->status === 'Pending')
                                <span class="badge bg-secondary">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No orders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="height: 50px;"></div>
    </div>
</div>
@endsection