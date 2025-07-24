@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Aktivitas Toko</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="callout callout-info">
                                                <small class="text-muted"><b>Total Omset</b></small>
                                                <br>
                                                <strong class="h4">Rp
                                                    {{ number_format($totalAmount, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="callout callout-info">
                                                <small class="text-muted">Omset Harian</small>
                                                <br>
                                                <strong class="h4">Rp
                                                    {{ number_format($dailyTotal, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="callout callout-danger">
                                                <small class="text-muted">Pelanggan</small>
                                                <br>
                                                <strong class="h4">{{ $custTotal }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="callout callout-primary">
                                                <small class="text-muted">Orderan Baru</small>
                                                <br>
                                                <strong class="h4">{{ $newOrderCount }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="callout callout-success">
                                                <small class="text-muted">Total Produk</small>
                                                <br>
                                                <strong class="h4">{{ $productTotal }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endSection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endSection

@section('js')
    <script>
        console.log('Hi!');
    </script>
@endSection
