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
            <div class="card-header d-flex justify-content-between flex-wrap">
                <form method="GET" action="{{ route('laporan.index') }}" class="form-inline mb-2 mb-md-0">
                    <input type="month" name="bulan" value="{{ request('bulan') }}" class="form-control mr-2">
                    <button type="submit" class="btn btn-primary mr-2">Cari</button>
                </form>

                {{-- <form method="GET" action="{{ route('laporan.export') }}">
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                    <button type="submit" class="btn btn-success">Export to Excel</button>
                </form> --}}
            </div>
            <div class="card-header d-flex justify-content-end">
    <form method="GET" action="{{ route('laporan.export') }}">
        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
        <button type="submit" class="btn btn-success">Export to Excel</button>
    </form>
</div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="font-size: 15px;">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Subtotal</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td>{{ $orders->firstItem() + $index }}</td>
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
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($orders->count())
                    <tfoot>
                        <tr>
                            <td colspan="5"><hr></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>

                <div class="mt-3">
                    {!! $orders->appends(request()->query())->links() !!}
                </div>

                {{-- Footer info --}}
                {{-- <div class="text-muted text-right mt-4" style="font-size: 13px;">
                    Dicetak pada: {{ now()->format('d M Y H:i') }} oleh {{ auth()->user()->name ?? 'Admin' }}
                </div> --}}
            </div>
        </div>
    </section>
</div>

{{-- Optional: Highlight row on hover --}}
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection
