<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   

    public function index()
    {
        $transaksi = Transaksi::with('produk')
            ->where('id_user', Auth::id())
            ->get();

        return view('user', compact('transaksi'));
    } 
}