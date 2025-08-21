<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahKategori = DB::table('kategori')->count();
        $jumlahProduk = DB::table('produk')->count();
        $jumlahTransaksi = DB::table('transaksi')->count();
        $jumlahUsers = DB::table('users')->count();

        return view('admin.dashboard', [
            'jumlahKategori' => $jumlahKategori,
            'jumlahProduk' => $jumlahProduk,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahUsers' => $jumlahUsers
        ]);
    }
}
