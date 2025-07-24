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
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Payment Confirmation</h1><br>
                <p class="display-5">Silahkan Lakukan Pembayaran Lewat No Rekening Berikut</p>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                
                <div class="row  mb-2 text-center">
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                        <div class="card-header">BCA</div>
                            <div class="card-body">
                                <h5 class="card-title">71118878</h5>
                                <p class="card-text">Atas Nama Dimas Badrussalam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                        <div class="card-header">BNI</div>
                            <div class="card-body">
                                <h5 class="card-title">71118878</h5>
                                <p class="card-text">Atas Nama Dimas Badrussalam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                        <div class="card-header">BRI</div>
                            <div class="card-body">
                                <h5 class="card-title">71118878</h5>
                                <p class="card-text">Atas Nama Dimas Badrussalam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                        <div class="card-header">Mandiri</div>
                            <div class="card-body">
                                <h5 class="card-title">71118878</h5>
                                <p class="card-text">Atas Nama Dimas Badrussalam</p>
                            </div>
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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('pay-fc', $order->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$order->id}}">
                        <input type="file" name="bukti" required>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
<script>
    // Jika terdapat pesan sukses
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500 // Tampilkan selama 1.5 detik, sesuaikan dengan kebutuhan Anda
        });
    @endif
</script>
@endsection
