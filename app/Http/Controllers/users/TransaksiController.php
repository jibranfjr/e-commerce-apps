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
            'id_produk' => 'required|array',
            'id_produk.*' => 'exists:produk,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
            'alamat' => 'required|string',
            'bank' => 'required|string',
            'nama_rekening' => 'required|string',
            'nomor_rekening' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        // Upload bukti transfer
        $file = $request->file('bukti_pembayaran');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // contoh: 64f1c23a9d8f7.jpg
        $file->storeAs('bukti-transfer', $filename, 'public');

        // Simpan transaksi utama
        $transaksi = \App\Models\Transaksi::create([
            'id_user' => Auth::id(),
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'nama_rekening' => $request->nama_rekening,
            'nomor_rekening' => $request->nomor_rekening,
            'bukti_pembayaran' => $filename,
            'status' => 'Pending',
        ]);

        foreach ($request->id_produk as $index => $produkId) {
            $produk = \App\Models\Produk::find($produkId);

            \App\Models\TransaksiDetail::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $produkId,
                'jumlah' => $request->jumlah[$index] ?? 1,
                'harga' => $produk->harga, 
            ]);

            \App\Models\Cart::where('id_user', Auth::id())
                ->where('id_produk', $produkId)
                ->delete();
        }

        return redirect()
        ->back()
        ->with('success', 'Pesanan berhasil dikirim!')
        ->with('invoice_id', $transaksi->id);
    }


    public function riwayat()
    {
        $transaksi = Transaksi::where('id_user', auth()->id())->get();

        return view('riwayat', compact('transaksi'));
    }
}

?>