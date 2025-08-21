<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();
        return view('admin.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori-tambah');
    }

    public function show($id)
    {
        $kategori = DB::table('kategori')->where('id', $id)->first();
        return view('admin.kategori-detail', compact('kategori'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori = $request->kategori;

        $exists = DB::table('kategori')->where('nama', $kategori)->exists();

        if ($exists) {
            return back()->with('error', 'Kategori sudah ada!');
        }

        DB::table('kategori')->insert([
            'nama' => $kategori
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori = DB::table('kategori')->where('id', $id)->first();

        if ($kategori->nama === $request->kategori) {
            return redirect()->route('admin.kategori.index');
        }

        $exists = DB::table('kategori')->where('nama', $request->kategori)->exists();
        if ($exists) {
            return back()->with('error', 'Kategori Sudah Ada');
        }

        DB::table('kategori')->where('id', $id)->update(['nama' => $request->kategori]);

        return back()->with('success', 'Kategori Berhasil Di Update');
    }

    public function destroy($id)
    {
        DB::table('kategori')->where('id', $id)->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori Berhasil Di Delete');
    }

}

