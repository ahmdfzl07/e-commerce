@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <?php $segments = ''; ?>
                            @for ($i = 1; $i <= count(Request::segments()); $i++)
                                <?php $segments .= '/' . Request::segment($i); ?>
                                @if ($i < count(Request::segments()))
                                    <li class="breadcrumb-item text-capitalize">{{ Request::segment($i) }}</li>
                                @else
                                    <li class="breadcrumb-item text-capitalize active">{{ Request::segment($i) }}</li>
                                @endif
                            @endfor
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Laporan Order
                                </h4>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form action="{{ route('report.order') }}" method="get">
                                    <div class="input-group mb-3 col-md-4 float-right">
                                        <input type="text" id="created_at" name="date" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">Filter</button>
                                        </div>
                                        <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>InvoiceID</th>
                                                <th>Pelanggan</th>
                                                <th>Subtotal</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $row)
                                                <tr>
                                                    <td><strong>{{ $row->invoice }}</strong></td>
                                                    <td>
                                                        <strong>{{ $row->customer_name }}</strong><br>
                                                        <label><strong>Telp:</strong> {{ $row->customer_phone }}</label><br>
                                                        <label><strong>Alamat:</strong> {{ $row->customer_address }}
                                                            {{ $row->customer->district->name }} - {{ $row->citie->name }},
                                                            {{ $row->citie->postal_code }}</label>
                                                    </td>
                                                    <td>Rp {{ number_format($row->subtotal) }}</td>
                                                    <td>{{ $row->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            $('#exportpdf').attr('href', 'order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                $('#exportpdf').attr('href', 'order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format(
                    'YYYY-MM-DD'))
            })
        })
    </script>
@endsection
