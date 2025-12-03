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
                <h1>Payment Confirmation</h1><br>
                <p class="display-5">Silahkan Lakukan Pembayaran Lewat No Rekening Berikut</p>
            </div>
        </div>
    </div>
</section> -->
<div class="container-fluid row">
    <div class="col-md-12">
        <h1>Payment Confirmation</h1>
        <div class="card">
            <div class="card-body">
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
                <div class="row  mb-4">
                    <div class="col-md-12 text-center">
                        Jumlah Transfer Sebesar <b>Rp.{{number_format($order->subtotal)}}</b> Ke No Rekening Di Atas
                    </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                    <form action="/costumer/payment/{{$order->invoice}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_id" value=" {{$order->id}} " required>
                        <input type="hidden" name="name" value=" {{$order->customer->name}} " required>
                        <input type="hidden" name="transfer_to" value="bank" required>
                        <input type="hidden" name="amount" value=" {{$order->cost}} " required>
                        <input type="file" name="proof" required>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
