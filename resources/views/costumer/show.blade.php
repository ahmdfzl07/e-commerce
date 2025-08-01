@extends('layouts.layout')

@section('title')
    Produk
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}">
@endsection

@section('produk')
    active
@endsection

@section('main')
    <!-- <section class="blog-banner-area" id="category">
                    <div class="container h-100">
                        <div class="blog-banner">
                            <div class="text-center">
                                <h1>{{ $product->name }}</h1>
                                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section> -->

    <div class="product_image_area">
        <div class="container">
            <h1>{{ $product->name }}</h1>
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ asset('products/' . $product->image) }}"
                                alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        @if (session('success'))
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @endif
                        <h3>{{ $product->name }}</h3>
                        @if ($product->price_discount == 0)
                            <h2>Rp. {{ number_format($product->price, 2, ',', '.') }}</h2>
                        @else
                            <h3 style="text-decoration: line-through; color:red;">Rp.
                                {{ number_format($product->price, 2, ',', '.') }}</h3>
                            <h2>Rp. {{ number_format($product->price_discount, 2, ',', '.') }}</h2>
                        @endif
                        <ul class="list">
                            <li><a class="active" href="#"><span>Kategori</span> : {{ $product->category->name }}</a>
                            </li>
                            @if ($product->stock == 0)
                                <li><a href="#"><span>Stok</span> : <span style="color: red;">Habis</span> </a></li>
                            @else
                                <li><a href="#"><span>Stok</span> : {{ $product->stock }}</a></li>
                            @endif
                            <li>
                                @if (Auth::guard('costumer')->check())
                                    <form action="{{ route('home.addcart') }}" method="post">
                                        @csrf
                                        <label
                                            for="qty"><span>Quantity</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                        <div class="product_count">
                                            <input type="hidden" name="customer_id"
                                                value="{{ Auth::guard('costumer')->user()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @if ($product->price_discount == 0)
                                                <input type="hidden" name="cart_price" value="{{ $product->price }}">
                                            @else
                                                <input type="hidden" name="cart_price"
                                                    value="{{ $product->price_discount }}">
                                            @endif
                                            <input type="hidden" name="cart_weight" value="{{ $product->weight }}">
                                            <input type="text" name="qty" id="sst" maxlength="12"
                                                value="1" title="Quantity:" class="input-text qty">
                                            <button
                                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                class="increase items-count" type="button"><i
                                                    class="lnr lnr-chevron-up"></i></button>
                                            <button
                                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                class="reduced items-count" type="button"><i
                                                    class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                        <hr>
                                     {{-- <a class="gray_btn" href="{{ route('home.product') }}">Lanjutkan Berbelanja</a> --}}
                                    <button class="button primary-btn" name="action" value="cart" type="submit">Tambah Keranjang</button>
                                    <button class="button primary-btn" name="action" value="buy" type="submit">Beli Sekarang</button>


                                    </form>
                                @else
                                    <label
                                        for="qty"><span>Quantity</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                            title="Quantity:" class="input-text qty">
                                        <button
                                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i
                                                class="lnr lnr-chevron-up"></i></button>
                                        <button
                                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i
                                                class="lnr lnr-chevron-down"></i></button>
                                    </div>

                            </li>
                            <hr>
                            <a class="button primary-btn" href=" {{ route('costumer.login') }} ">Add to cart</a>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Specification</a>
                </li>
            </ul>
            <div class="tab-content shadow" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Harga</h5>
                                    </td>
                                    <td>
                                        <h5>Rp. {{ number_format($product->price) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Stok</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $product->stock }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Kategori</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $product->category->name }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    <!-- SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    <script>
        // Jika terdapat pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // Tampilkan selama 1.5 detik, sesuaikan dengan kebutuhan Anda
            });
        @endif
    </script>
    <script>
        // Jika terdapat pesan sukses
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000 // Tampilkan selama 1.5 detik, sesuaikan dengan kebutuhan Anda
            });
        @endif
    </script>
@endsection
