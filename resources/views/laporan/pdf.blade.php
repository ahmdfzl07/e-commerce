<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            position: relative;
        }

        .watermark {
            position: fixed;
            top: 35%;
            left: 10%;
            width: 100%;
            text-align: center;
            opacity: 0.1;
            transform: rotate(-30deg);
            z-index: -1;
            font-size: 100px;
            font-weight: bold;
            color: #000;
            pointer-events: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .total {
            font-weight: bold;
            background-color: #eee;
        }
    </style>
</head>
<body>
    {{-- Watermark --}}
    <div class="watermark">MARTIN KONTOL</div>

    <h2>Laporan Penjualan</h2>
    <h4>Bulan: {{ $bulan }}</h4>
    <br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Alamat</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($orders as $order)
                @php $total += $order->total; @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->customer->address }}</td>
                    <td class="text-right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $order->status }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="5" class="text-right">Total Keseluruhan</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
