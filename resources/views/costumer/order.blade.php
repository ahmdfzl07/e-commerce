@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/linericon/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/nouislider/nouislider.min.css')}}">
<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
    }
</style>
@endsection

@section('title')
    Order
@endsection

@section('main')
<!-- ================ start banner area ================= -->
<!-- <section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Konfirmasi Pesanan</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
        </ol>
      </nav>
            </div>
        </div>
</div>
</section> -->
<!-- ================ end banner area ================= -->

<!--================Order Details Area =================-->
<section style="padding: 60px 0; background: #f7f9fc; font-family: 'Segoe UI', sans-serif;">
  <div class="container">
    <h1 style="text-align: center; font-size: 32px; margin-bottom: 40px; color: #333;">Konfirmasi Pesanan</h1>

    <div class="row text-center mb-4">
      <!-- Bank BCA -->
      <div class="col-md-3">
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 20px;">
          <img src="/dist/img/bni.jpeg" alt="BCA" style="height: 40px; margin-bottom: 10px;">
          <h5 style="margin: 10px 0;">7112113277</h5>
          <p style="margin: 0;">a.n. Reza Haidar</p>
        </div>
      </div>
      <!-- Bank BNI -->
      <div class="col-md-3">
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 20px;">
          <img src="/dist/img/bni.jpeg" alt="BNI" style="height: 40px; margin-bottom: 10px;">
          <h5 style="margin: 10px 0;">7112113277</h5>
          <p style="margin: 0;">a.n. Reza Haidar</p>
        </div>
      </div>
      <!-- Bank BRI -->
      <div class="col-md-3">
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 20px;">
          <img src="/dist/img/bri.jpeg" alt="BRI" style="height: 40px; margin-bottom: 10px;">
          <h5 style="margin: 10px 0;">7112113277</h5>
          <p style="margin: 0;">a.n. Reza Haidar</p>
        </div>
      </div>
      <!-- Bank Mandiri -->
      <div class="col-md-3">
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 20px;">
          <img src="/dist/img/mandiri.jpeg" alt="Mandiri" style="height: 40px; margin-bottom: 10px;">
          <h5 style="margin: 10px 0;">7112113277</h5>
          <p style="margin: 0;">a.n. Reza Haidar</p>
        </div>
      </div>
    </div>

    <p class="text-center" style="color: #28a745; font-weight: bold;">Terima kasih sudah memesan.</p>
            <div class="text-center">
            <a href="/costumer/order-detail" class="btn btn-primary">
                Upload Bukti Pembayaran
            </a>
        </div>

    <div class="text-center my-4">
      <a href="/costumer/pdf/{{$order->id}}">
        <button style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-size: 16px;">
          Download Invoice
        </button>
      </a>
    </div>

    <hr>

    <!-- Order Info, Billing, Shipping -->
    <div class="row mb-5">
      <div class="col-md-6 col-xl-4 mb-4">
        <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
          <h4>Order Info</h4>
          <table style="width: 100%; margin-top: 15px;">
            <tr><td>Nama</td><td>: {{$order->customer->name}}</td></tr>
            <tr><td>Invoice</td><td>: {{$order->invoice}}</td></tr>
            <tr><td>Tanggal</td><td>: {{$order->created_at->format('d, M Y')}}</td></tr>
            <tr><td>Total</td><td>: Rp. {{number_format($order->cost)}}</td></tr>
          </table>
        </div>
      </div>

      <div class="col-md-6 col-xl-4 mb-4">
        <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
          <h4>Billing Alamat</h4>
          <table style="width: 100%; margin-top: 15px;">
            <tr><td>Alamat</td><td>: {{$order->customer_address}}</td></tr>
            <tr><td>Kecamatan</td><td>: {{$order->district->name}}</td></tr>
            <tr><td>Kota</td><td>: {{$order->citie->name}}</td></tr>
            <tr><td>Kode Pos</td><td>: {{$order->citie->postal_code}}</td></tr>
          </table>
        </div>
      </div>

      <div class="col-md-6 col-xl-4 mb-4">
        <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
          <h4>Shipping Alamat</h4>
          <table style="width: 100%; margin-top: 15px;">
            <tr><td>Street</td><td>: Curug</td></tr>
            <tr><td>City</td><td>: Tangerang</td></tr>
            <tr><td>Negara</td><td>: Indonesia</td></tr>
            <tr><td>Kode Pos</td><td>: 1205</td></tr>
          </table>
        </div>
      </div>
    </div>

    <!-- Order Detail Table -->
    <div class="order_details_table">
      <h2 style="margin-bottom: 20px;">Detail Pesanan</h2>
      <div class="table-responsive">
        <table class="table" style="background: #fff; border-radius: 10px; overflow: hidden;">
          <thead style="background: #f1f1f1;">
            <tr>
              <th>Produk</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$order_detail->product->name}}</td>
              <td>x {{$order_detail->qty}}</td>
              <td>Rp. {{number_format($order_detail->price * $order_detail->qty)}}</td>
            </tr>
            <tr>
              <td><strong>Subtotal</strong></td>
              <td></td>
              <td>Rp. {{number_format($order->subtotal)}}</td>
            </tr>
            <tr>
              <td><strong>Shipping</strong></td>
              <td></td>
              <td>Rp. {{number_format($order->shipping)}}</td>
            </tr>
            <tr>
              <td><strong>Total</strong></td>
              <td></td>
              <td><strong>Rp. {{number_format($order->cost)}}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>

<!--================End Order Details Area =================-->
@endsection
