<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Ambil 1 transaksi, jangan pake get()
        $transaksi = Transaksi::with(['user', 'details.produk'])->findOrFail($id);
        $details = $transaksi->details;

        // Generate PDF
        $pdf = Pdf::loadView('invoice', compact('transaksi', 'details'));
        return $pdf->download('invoice.pdf');
    }
}
