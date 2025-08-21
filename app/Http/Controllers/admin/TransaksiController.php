<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user')->get();
        return view('admin.transaksi', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'produk'])->findOrFail($id);
        return view('admin.transaksi-detail', compact('transaksi'));
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'Konfirmasi Pemesanan';
        $transaksi->save();

        return back()->with('success', 'Pesanan sudah dikonfirmasi.');
    }

    public function destroy($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi Berhasil Delete.');
    }
}