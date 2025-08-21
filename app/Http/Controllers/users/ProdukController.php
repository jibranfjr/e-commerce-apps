<?php

namespace App\Http\Controllers\users;

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $keyword = $request->keyword;
        $filterKategori = $request->kategori;

        if ($keyword) {
            $produk = Produk::where('nama', 'like', "%$keyword%")->get();
        } elseif ($filterKategori) {
            $kategoriModel = Kategori::where('nama', $filterKategori)->first();
            $produk = $kategoriModel ? Produk::where('id_kategori', $kategoriModel->id)->get() : collect();
        } else {
            $produk = Produk::all();
        }

        return view('produk', compact('produk', 'kategori', 'keyword', 'filterKategori'));
    }

    public function show($nama)
    {
        $produk = Produk::where('nama', $nama)->firstOrFail();
        $produkTerkait = Produk::where('id_kategori', $produk->id_kategori)
                            ->where('id', '!=', $produk->id)
                            ->limit(4)
                            ->get();
        return view('produk-detail', compact('produk', 'produkTerkait'));
    }
}

?>