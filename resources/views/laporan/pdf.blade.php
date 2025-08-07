<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="70%">
                <h2>LAPORAN PESANAN</h2>
                <p>Bulan: <strong>{{ \Carbon\Carbon::parse($bulan)->format('F Y') }}</strong></p>
                <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
                <hr>
            </td>
            <td width="30%" align="right">
                <img src="{{ public_path('dist/img/logo.png') }}" width="100" alt="Logo H. ILI MOTOR">
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

    {{-- FOOTER --}}
    <div style="margin-top: 30px; text-align: center;">
        <p>Terima kasih telah menggunakan layanan <strong>H. ILI MOTOR</strong>.</p>
    </div>

</body>
</html>
