<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function transaksiPdf()
    {
        $transaksi = Transaksi::with(['user', 'produk'])->get();
        
        $pdf = Pdf::loadView('laporan.transaksi_pdf', compact('transaksi'));

        return $pdf->download('laporan_transaksi.pdf');
    }
}