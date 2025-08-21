<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class TransaksiController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|integer|exists:produk,id',
            'alamat' => 'required|string',
            'bank' => 'required|string',
            'nama_rekening' => 'required|string',
            'nomor_rekening' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:2048',           
            'jumlah' => 'required|integer',
        ]);

        $fotoPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $fotoPath = $request->file('bukti_pembayaran')->store('bukti-transfer', 'public');
        }

        \App\Models\Transaksi::create([
            'id_user' => Auth::id(),
            'id_produk' => $request->id_produk,
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'nama_rekening' => $request->nama_rekening,
            'nomor_rekening' => $request->nomor_rekening, 
            'jumlah' => $request->jumlah,
            'bukti_pembayaran' => $fotoPath,
            'status' => 'Pending'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }

    public function riwayat()
    {
        $transaksi = Transaksi::where('id_user', auth()->id())->get();

        return view('riwayat', compact('transaksi'));
    }
}

?>