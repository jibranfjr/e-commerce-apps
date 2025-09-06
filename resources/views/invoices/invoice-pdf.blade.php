<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaksi->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 0;
        }
        .invoice {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            padding: 20mm;
            background: #fff;
            box-sizing: border-box;
        }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #f0f0f0; }
        .total { text-align: right; margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h2>Invoice</h2>
            <p>No: INV-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <p><strong>Customer:</strong> {{ $transaksi->user->name ?? 'Guest' }}</p>
        <p><strong>Email:</strong> {{ $transaksi->user->email ?? '-' }}</p>
        <p><strong>Date:</strong> {{ optional($transaksi->created_at)->format('d M Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($details as $i => $detail)
                    @php
                        $unitPrice = $detail->harga ?? ($detail->produk->harga ?? 0);
                        $subtotal = $detail->jumlah * $unitPrice;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $detail->produk->nama ?? 'Produk tidak ada' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
    </div>
</body>
</html>
