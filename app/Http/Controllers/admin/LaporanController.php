<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function transaksiPdf(Request $request)
    {
        $query = Transaksi::with(['user', 'details.produk']);

        // Filter per minggu
        if ($request->filter === 'minggu') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        }

        // Filter per bulan
        if ($request->filter === 'bulan') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        }

        // Filter custom range
        if ($request->filter === 'custom' && $request->filled(['start_date','end_date'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $transaksi = $query->get();

        $pdf = Pdf::loadView('laporan.transaksi_pdf', compact('transaksi'));
        return $pdf->download('laporan_transaksi.pdf');
    }
}
