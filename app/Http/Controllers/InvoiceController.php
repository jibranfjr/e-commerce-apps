<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // ambil transaksi + details + produk + user sekaligus
        $transaksi = Transaksi::with('details.produk', 'user')->findOrFail($id);
        $details = $transaksi->details; // koleksi TransaksiDetail

        return view('invoices.invoice-pdf', compact('transaksi', 'details'));
    }

    public function download($id)
    {
        $transaksi = Transaksi::with('details.produk', 'user')->findOrFail($id);
        $details = $transaksi->details;

        // pastikan nama view di sini sama dengan yang kamu edit
        $pdf = Pdf::loadView('invoices.invoice-pdf', compact('transaksi', 'details'));
        return $pdf->download('invoice-' . $transaksi->id . '.pdf');
    }
}