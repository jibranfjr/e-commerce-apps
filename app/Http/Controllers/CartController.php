<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $keranjang = Cart::where('id_user', Auth::id())->with('produk')->get();
        return view('cart', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $keranjang = Cart::where('id_user', Auth::id())
                    ->where('id_produk', $request->id_produk)
                    ->first();

        if ($keranjang) {
            // Kalau sudah ada, tambahkan quantity
            $keranjang->quantity += $request->quantity;
            $keranjang->save();
        } else {
            // Kalau belum ada, buat baru
            Cart::create([
                'id_user'   => Auth::id(),
                'id_produk' => $request->id_produk,
                'quantity'  => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }
}
