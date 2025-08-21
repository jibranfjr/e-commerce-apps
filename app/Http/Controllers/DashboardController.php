<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = Produk::limit(6)->get();
        return view('dashboard', compact('produk'));
    }
}

?>