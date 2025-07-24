@extends('layouts.layout')

@section('title')
    SEBELAH GDNG
@endsection

@section('full_custom')
    active
@endsection

<style>
    a.active {
        color: blue;
    }

    a.inactive {
        color: black;
    }

    .active-btn {
        background-color: #007bff;
        color: white;
    }
</style>

@section('main')
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>SEBELAH GDNG</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SEBELAH GDNG</li>
                        </ol>
                    </nav>
                    <br>
                    <button id="btnPesananBaru" class="btn btn-outline-primary active-btn"
                        onclick="showPesananBaru()">Pesanan Baru</button>
                    <button id="btnListPesanan" class="btn btn-outline-primary" onclick="showListPesanan()">List
                        Pesanan</button>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section-margin--small" id="pesananBaruSection">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="{{ route('home.checkoutProsesCustom') }}" method="post"
                            novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 form-group p_star">
                                <input type="hidden" name="invoice" value="{{ 'INV/FC-' . Str::random(4) . '-' . time() }}"
                                    required>
                                <input type="hidden" name="customer_id" value="{{ Auth::guard('costumer')->user()->id }}"
                                    required>
                                <input type="text" class="form-control" id="first" name="customer_name"
                                    value="{{ Auth::guard('costumer')->user()->name }}" required>
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" name="customer_phone"
                                    value="{{ Auth::guard('costumer')->user()->phone_number }}" required>
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="customer_address"
                                    value="{{ Auth::guard('costumer')->user()->address }}" required>
                                <input type="hidden" class="form-control" name="district_id"
                                    value="{{ Auth::guard('costumer')->user()->district_id }}" required>
                                <input type="hidden" class="form-control" name="citie_id"
                                    value="{{ Auth::guard('costumer')->user()->citie_id }}" required>
                                <input type="hidden" class="form-control" name="subtotal" id="subtotal" value=""
                                    required>
                                <input type="hidden" class="form-control" name="status" value="0" required>
                            </div>
                            <div class="row col-md-12 form-group">
                                <div class="col-6">
                                    <label for="photo">Upload Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        accept="image/*" required onchange="previewPhoto()">
                                    <div id="photo-preview" style="margin-top: 10px;"></div>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Product Name" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="number" class="form-control" id="photo_width" name="photo_width"
                                    placeholder="Width (meters)" required onkeyup="calculatePrice()">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="number" class="form-control" id="photo_height" name="photo_height"
                                    placeholder="Height (meters)" required onkeyup="calculatePrice()">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="hidden" class="form-control" id="photo_price" value="1800000">
                            </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Pesanan Anda</h2>
                            <ul class="list list_2">
                                <li><a href="#">Product <span id="product"></span></a></li>
                                <li><a href="#">Panjang <span id="panjang"></span></a></li>
                                <li><a href="#">Lebar <span id="lebar"></span></a></li>
                                <li><a href="#">Subtotal <span id="order_subtotal"></span></a></li>
                                <li><a href="#">Total <span id="total"></span></a></li>
                            </ul>
                            <div class="text-center">
                                <button class="button button-paypal" type="submit">Pesan</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="list_pesanan section-margin--small" id="listPesananSection" style="display: none;">
        <div class="container">
            <h3>List Pesanan</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Product Name</th>
                        <th>Width (meters)</th>
                        <th>Height (meters)</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $order)
                        <tr>
                            <td>{{ $order->invoice }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->photo_width }}</td>
                            <td>{{ $order->photo_height }}</td>
                            <td>Rp. {{ number_format($order->subtotal) }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge badge-warning">Silahkan melakukan pembayaran terlebih dahulu</span>
                                @elseif ($order->status == 1)
                                    <span class="badge badge-warning">Menunggu Konfirmasi admin</span>
                                @elseif ($order->status == 2)
                                    <span class="badge badge-warning">Sedang Diproses</span>
                                @elseif ($order->status == 3)
                                    <span class="badge badge-warning">Sedang Dikirim</span>
                                @elseif ($order->status == 4)
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    @if ($order->status == 0)
                                        <a href="{{ route('home.payment-fc-form', $order->id) }}"
                                            class="btn btn-primary">Bayar</a>
                                    @elseif ($order->status == 3)
                                        <form action="{{ route('full_custom.update.cust', $order->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="status" value="4">
                                            <button class="btn btn-primary btn-sm" type="submit">Update ke Sudah
                                                diterima</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('full_custom.show', $order->id) }}"
                                        class="btn btn-secondary">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    <script>
        // Jika terdapat pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500 // Tampilkan selama 1.5 detik, sesuaikan dengan kebutuhan Anda
            });
        @endif
    </script>
    <script>
        function showPesananBaru() {
            document.getElementById('pesananBaruSection').style.display = 'block';
            document.getElementById('listPesananSection').style.display = 'none';
            document.getElementById('btnPesananBaru').classList.add('active-btn');
            document.getElementById('btnListPesanan').classList.remove('active-btn');
        }

        function showListPesanan() {
            document.getElementById('pesananBaruSection').style.display = 'none';
            document.getElementById('listPesananSection').style.display = 'block';
            document.getElementById('btnPesananBaru').classList.remove('active-btn');
            document.getElementById('btnListPesanan').classList.add('active-btn');
        }

        function previewPhoto() {
            const photoInput = document.getElementById('photo');
            const preview = document.getElementById('photo-preview');

            preview.innerHTML = '';
            const file = photoInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        }

        function calculatePrice() {
            const width = document.getElementById('photo_width').value;
            const height = document.getElementById('photo_height').value;
            const pricePerMeter = document.getElementById('photo_price').value;

            const subtotal = width * height * pricePerMeter;
            document.getElementById('subtotal').value = subtotal;

            document.getElementById('product').innerText = document.getElementById('product_name').value;
            document.getElementById('panjang').innerText = width + ' meters';
            document.getElementById('lebar').innerText = height + ' meters';
            document.getElementById('order_subtotal').innerText = 'Rp ' + subtotal.toLocaleString();
            document.getElementById('total').innerText = 'Rp ' + subtotal.toLocaleString();
        }
    </script>
@endsection
