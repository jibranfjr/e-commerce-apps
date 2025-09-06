<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 10px; }
        .total { font-weight: bold; }
        .empty-report { text-align: center; margin-top: 50px; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>

    @if($transaksi->isEmpty())
        <p class="empty-report">Laporan transaksi kosong untuk periode ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama User</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $index => $item)
                    @php
                        $rowspan = $item->details->count();
                    @endphp

                    @foreach ($item->details as $i => $detail)
                        <tr>
                            @if ($i == 0)
                                <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $item->user->username ?? 'Tidak Diketahui' }}</td>
                            @endif
                            <td>{{ $detail->produk->nama ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                            @if ($i == 0)
                                <td rowspan="{{ $rowspan }}">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            @endif
                        </tr>
                    @endforeach

                    {{-- baris total per transaksi --}}
                    <tr>
                        <td colspan="5" class="total">Total Transaksi</td>
                        <td colspan="2" class="total">
                            Rp {{ number_format($item->details->sum(fn($d) => $d->jumlah * $d->harga), 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
 