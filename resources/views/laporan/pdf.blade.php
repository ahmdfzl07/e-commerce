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

        /* .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-image: url('{{ public_path("dist/img/bg.jpeg") }}');
            background-size: cover;
            background-position: center;
            opacity: 1;
        } */
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    {{-- Watermark --}}
    {{-- <div class="bg-image"></div> --}}

    {{-- <div class="watermark">MARTIN KONTOL</div> --}}

      <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="70%">
                <h2>LAPORAN PESANAN</h2>
                <p>Bulan: <strong>{{ \Carbon\Carbon::parse($bulan)->format('F Y') }}</strong></p>
                <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
                <hr>
            </td>
            <td width="30%" align="right">
                <img src="{{ public_path('dist/img/logo.png') }}" width="80" alt="Logo H. ILI MOTOR">
            </td>
        </tr>
    </table>

    {{-- TABEL PESANAN --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->customer_name }}<br><small>{{ $order->customer_address }}</small></td>
                    <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total</th>
                <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
