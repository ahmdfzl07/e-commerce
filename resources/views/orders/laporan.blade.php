@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Laporan Pesanan</h1>
        </div>
    </section>

    <section class="content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <form method="GET" action="{{ route('laporan.index') }}">
                    <input type="month" name="bulan" value="{{ request('bulan') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Subtotal</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td><strong>{{ $order->invoice }}</strong></td>
                                <td>
                                    <strong>{{ $order->customer_name }}</strong><br>
                                    <small>{{ $order->customer_address }}</small>
                                </td>
                                <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right">Total</th>
                            <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-3">
                    {!! $orders->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
