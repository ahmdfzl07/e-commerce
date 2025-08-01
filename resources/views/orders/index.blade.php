@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pesanan</h1>
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
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Pesanan</h4>
                        </div>
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="" method="get">
                                <div class="input-group mb-3 col-md-6 float-right">
                                    <select name="status" class="form-control mr-3">
                                        <option value="">Pilih Status</option>
                                        <option value="0">Baru</option>
                                        <option value="1">Confirm</option>
                                        <option value="2">Proses</option>
                                        <option value="3">Dikirim</option>
                                        <option value="4">Selesai</option>
                                    </select>
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </div>
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
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                            <th>Detail Order</th>
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
                                                        {{ $row->customer->district->name ?? '-' }} -
                                                        {{ $row->citie->name ?? '-' }},
                                                        {{ $row->citie->postal_code ?? '-' }}
                                                    </label>
                                                </td>
                                                <td>Rp {{ number_format($row->subtotal) }}</td>
                                                <td>{{ $row->created_at->format('d M Y') }}</td>
                                                <td>
                                                    @if ($row->payment && $row->payment->proof)
                                                        <a data-toggle="modal" data-target="#proofModal{{ $row->id }}">
                                                            <img class="card-img" src="{{ asset('payment/' . $row->payment->proof) }}" style="height: 100px; width: auto;" alt="{{ $row->payment->proof }}">
                                                        </a>

                                                        <!-- Modal Bukti Pembayaran -->
                                                        <div class="modal fade" id="proofModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel{{ $row->id }}" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <img src="{{ asset('payment/' . $row->payment->proof) }}" class="img-fluid" alt="{{ $row->payment->proof }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ asset('payment/' . $row->payment->proof) }}" class="btn btn-primary" download>Download</a>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="badge badge-danger">Belum bayar</span>
                                                    @endif
                                                </td>
                                                <td>{!! $row->status_label !!}</td>
                                                <td>
                                                    @if ($row->status == 0)
                                                        <form action="destroy/{{ $row->id }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                                                        </form>
                                                    @elseif ($row->status == 1)
                                                        <form action="update/{{ $row->id }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button class="btn btn-outline-success btn-sm">Update ke Proses</button>
                                                        </form>
                                                    @elseif ($row->status == 2)
                                                        <form action="update/{{ $row->id }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="3">
                                                            <button class="btn btn-info btn-sm">Update ke Dikirim</button>
                                                        </form>
                                                    @elseif ($row->status == 3)
                                                        <span class="badge badge-warning">Tunggu customer update ke Selesai</span>
                                                    @elseif ($row->status == 4)
                                                        <a class="btn btn-outline-danger btn-sm" href="/costumer/pdf/{{ $row->id }}">View invoice</a>
                                                    @endif
                                                </td>
                                              <td>
    @if ($row->details && $row->details->count() > 0)
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal{{ $row->id }}">
            Lihat Detail
        </button>

        <!-- Modal -->
        <div class="modal fade" id="detailModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $row->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $row->id }}">Detail Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($row->details as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->product->name ?? 'Produk tidak ditemukan' }}</td>
                                        <td>Rp {{ number_format($detail->price) }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp {{ number_format($detail->price * $detail->qty) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <span class="badge badge-danger">Tidak ada detail</span>
    @endif
</td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {!! $orders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- SweetAlert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>
@endsection
