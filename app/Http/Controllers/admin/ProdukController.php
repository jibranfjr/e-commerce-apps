<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('admin.produk', compact('produk'));
    }

    public function create()
    {
    $kategori = Kategori::all();
    return view('admin.produk-tambah', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:500',
            'detail' => 'nullable|string',
            'ketersediaan_stok' => 'required|in:Tersedia,Habis',
        ]);

        $data = $request->except('foto');
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
            $data['foto'] = $filename;
        }

        Produk::create($data);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        $kategoriLain = Kategori::where('id', '!=', $produk->kategori_id)->get();

        return view('admin.produk-detail', compact('produk', 'kategoriLain'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|exists:kategori,id',
            'harga' => 'required|numeric',
            'detail' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,png,gif|max:500',
        ]);

        $produk->nama = $request->nama;
        $produk->id_kategori = $request->kategori;
        $produk->harga = $request->harga;
        $produk->detail = $request->detail;
        $produk->ketersediaan_stok = $request->ketersediaan_stok;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $namaFile);
            $produk->foto = $namaFile;
        }

        $produk->save();

        return back()->with('success', 'Produk Berhasil Di Update');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index', ['id' => $id])->with('success', 'Produk berhasil Di Delete.');
    }
}
