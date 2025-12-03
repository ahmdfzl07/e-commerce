<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->invoice }}</title>
</head>
        <body>
                    <table width="800" border="0" cellpadding="10" cellspacing="0" align="center">
                      <tr>
                        <td align="left" width="70%">
                            <h2>INVOICE</h2>
                            <p>No: <strong>#{{ $order->invoice }}</strong></p>
                            <p>Tanggal: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</p>
                            <hr style="width: 114%; margin-left: 0;">
                        </td>
                        <td align="left" width="30%" style="padding-left: 1px;">
                            <img src="{{ public_path('dist/img/logo.png') }}" alt="Logo" width="80"><br>
                        </td>
                    </tr>


                <tr>
                    <td width="50%" valign="top">
                        <strong>PENERIMA:</strong><br>
                        {{ $order->customer_name }}<br>
                        {{ $order->customer_phone }}<br>
                        {{ $order->customer_address }}<br>
                        {{ $order->district->name }}, {{ $citie->name }}<br>
                        {{ $citie->postal_code }}
                    </td>
                    <td width="50%" style="padding-left: 1px" valign="top" >
                        <strong>PENGIRIM:</strong><br>
                       SINAR JAYA FURNITURE<br>
                        085343966997<br>
                        Jl Pasar Kemis<br>
                        Kab Tangerang<br>
                        Banten
                    </td>
                </tr>

                <tr><td colspan="2"><br></td></tr>

                <tr>
                    <td colspan="2">
                        <table width="65%" border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th align="left">Nama Produk</th>
                    <th align="right">Harga Satuan</th>
                    <th align="center">Qty</th>
                    <th align="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; $grandTotal = 0; @endphp
                @foreach ($order_detail as $row)
                    @php
                        $subtotal = $row->price * $row->qty;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td align="center">{{ $no++ }}</td>
                        <td>{{ $row->product->name }}</td>
                        <td align="right">Rp {{ number_format($row->price) }}</td>
                        <td align="center">{{ $row->qty }}</td>
                        <td align="right">Rp {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" align="right"><strong>Total:</strong></td>
                    <td align="right"><strong>Rp {{ number_format($grandTotal) }}</strong></td>
                </tr>
            </tbody>
        </table>

            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td colspan="2" align="center">
                <br><br>
                <p>Terima kasih telah berbelanja di <strong>SINAR JAYA FURNITURE</strong>.</p>
            </td>
        </tr>
    </table>
</body>
</html>
