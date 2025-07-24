@extends('layouts.layout')

@section('title')
    SEBELAH GDNG Detail
@endsection

@section('full_custom')
    active
@endsection

<style>
    .order-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-details img {
        max-width: 500px;
        height: auto;
    }

    .input-flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        margin: 20px 0;
    }

    .input-flex-container::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background: #e0e0e0;
        z-index: 1;
    }

    .input {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2;
    }

    .input .circle {
        background: #fff;
        border: 2px solid #230ca6;
        border-radius: 50%;
        padding: 10px;
        width: 20px;
        height: 20px;
    }

    .input.active .circle {
        border-color: #5107ff;
        background-color: #230ca6;
    }

    .input span {
        margin-top: 10px;
        text-align: center;
    }
</style>

@section('main')
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>SEBELAH GDNG Detail</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SEBELAH GDNG Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section-margin--small" id="pesananBaruSection">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="input-flex-container mb-5">
                <div class="input @if ($custom->status == 0) active @endif">
                    <div class="circle"></div>
                    <span>Menunggu Pembayaran</span>
                </div>
                <div class="input @if ($custom->status == 1) active @endif">
                    <div class="circle"></div>
                    <span>Menunggu Konfirmasi Admin</span>
                </div>
                <div class="input @if ($custom->status == 2) active @endif">
                    <div class="circle"></div>
                    <span>Sedang Diproses</span>
                </div>
                <div class="input @if ($custom->status == 3) active @endif">
                    <div class="circle"></div>
                    <span>Sedang Dikirim</span>
                </div>
                <div class="input @if ($custom->status == 4) active @endif">
                    <div class="circle"></div>
                    <span>Selesai</span>
                </div>
            </div>

            <div class="order-details">
                <div class="order-image">
                    <img src="{{ asset('full_custom/' . $custom->photo) }}" alt="Order Photo">
                </div>
                <div class="order-info">
                    <h2>Order Details</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Invoice</th>
                            <td>{{ $custom->invoice }}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $custom->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Width (meters)</th>
                            <td>{{ $custom->photo_width }}</td>
                        </tr>
                        <tr>
                            <th>Height (meters)</th>
                            <td>{{ $custom->photo_height }}</td>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <td>Rp. {{ number_format($custom->subtotal) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($custom->status == 0)
                                    <span class="badge badge-warning">Silahkan melakukan pembayaran terlebih dahulu</span>
                                @elseif ($custom->status == 1)
                                    <span class="badge badge-warning">Menunggu Konfirmasi admin</span>
                                @elseif ($custom->status == 2)
                                    <span class="badge badge-warning">Sedang Diproses</span>
                                @elseif ($custom->status == 3)
                                    <span class="badge badge-warning">Sedang Dikirim</span>
                                @elseif ($custom->status == 4)
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        @if ($custom->status == 0)
                            <form action="{{ route('home.full_custom', $custom->id) }}" method="post"
                                style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Mark as Paid</button>
                            </form>
                        @endif
                        <a href="{{ route('home.full_custom') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
@endsection
