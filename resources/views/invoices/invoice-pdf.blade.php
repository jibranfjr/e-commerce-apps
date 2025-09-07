<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaksi->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h1 { color: #009879; margin: 0; font-size: 22px; }
        .header p { margin: 2px 0; font-size: 12px; color: #555; }

        .divider { border-top: 2px solid #009879; margin: 15px 0; }

        .info-table { width: 100%; border: none; margin-bottom: 10px; }
        .info-table td { border: none; vertical-align: top; padding: 5px; }
        .status { display: inline-block; padding: 5px 10px; border: 1px solid #009879; 
                  color: #009879; border-radius: 5px; font-weight: bold; font-size: 11px; background: #eaf7f1; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #009879; padding: 8px; text-align: left; }
        th { background-color: #eaf7f1; color: #065f46; }
        td.right { text-align: right; }

        .total { margin-top: 5px; text-align: right; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>
    <div class="invoice">
        <!-- Header -->
        <div class="header">
            <h1>PURI BALI</h1>
            <p>Toko Permata</p>
            <p>Jl. Ahmad Yani Selatan no. 16, Denpasar Utara</p>
            <p>Telp: +62 858-5062-4650 | Email: puribalitokopermata@gmail.com</p>
        </div>

        <div class="divider"></div>

        <!-- Invoice Info -->
        <table class="info-table">
            <tr>
                <!-- Left: Invoice -->
                <td>
                    <strong style="color:#009879;">INVOICE</strong><br>
                    Nomor: INV-{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}<br>
                    Tanggal: {{ optional($transaksi->created_at)->format('d/m/Y') }}<br>
                    Jatuh Tempo: {{ optional($transaksi->jatuh_tempo)->format('d/m/Y') }}

                </td>

                <!-- Middle: Status -->
                <td style="text-align: center;">
                    <b>Status:</b><br>
                    <span class="status">{{ strtoupper($transaksi->status ?? 'PENDING') }}</span>
                </td>

                <!-- Right: TO -->
                <td style="text-align: right;">
                    <strong style="color:#009879;">TO:</strong><br>
                    {{ $transaksi->user->username ?? 'Guest' }}<br>
                    {{ $transaksi->user->email ?? '-' }}
                </td>
            </tr>
        </table>

        <!-- Detail -->
        <h3 style="margin-top: 10px;">DETAIL TRANSACTION</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="right">Quantity</th>
                    <th class="right">Unit Price</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($details as $detail)
                    @php
                        $unitPrice = $detail->harga ?? ($detail->produk->harga ?? 0);
                        $subtotal = $detail->jumlah * $unitPrice;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $detail->produk->nama ?? 'Produk tidak ada' }}</td>
                        <td class="right">{{ $detail->jumlah }}</td>
                        <td class="right">Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <p class="total">Subtotal: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
        <p class="total" style="color:#009879;">Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
    </div>
</body>
</html>
