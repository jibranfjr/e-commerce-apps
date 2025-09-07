<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        $transaksi = Transaksi::with(['user', 'details.produk'])->findOrFail($id);
        $details = $transaksi->details;
        $transaksi->jatuh_tempo = $transaksi->created_at->copy()->addDay();

        $pdf = Pdf::loadView('invoices.invoice-pdf', compact('transaksi', 'details'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('Invoice-' . $transaksi->id . '.pdf');
    }
}
