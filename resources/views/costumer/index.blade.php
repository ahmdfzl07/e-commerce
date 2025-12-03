@extends('layouts.layout')

@section('title')
    Home
@endsection

@section('index')
    active
@endsection

@section('main')
  <main class="site-main">

    <!-- =============== Hero Banner =============== -->
    <section style="background: linear-gradient(135deg, #838180, #847bfe); padding: 80px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <h4 style="font-size: 22px; font-weight: 400;">Belanja itu menyenangkan</h4>
                    <h1 style="font-size: 48px; font-weight: bold; line-height: 1.2;">Jelajahi Produk<br>Premium Kami</h1>
                    <p style="font-size: 16px; margin: 20px 0;">Kami menyediakan berbagai macam FURNITURE  berkualitas tinggi untuk  Anda. Dengan stok lengkap dan harga bersaing.</p>
                    <a href="{{ route('home.product') }}" style="background: #fff; color: #ff6b4a; padding: 12px 28px; border-radius: 30px; font-weight: bold; text-decoration: none;">Belanja Sekarang</a>
                </div>
                {{-- <div class="col-md-6 text-center">
                    <img src="{{ asset('dist/img/logo.png') }}" alt="Sparepart" style="max-width: 100%; height: auto;">
                </div> --}}
            </div>
        </div>
    </section>

    <!-- =============== Trending Product Section =============== -->
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <p style="font-size: 18px; color: #6c757d;">Tampil trendi dengan produk terbaru kami.</p>
                <h2 style="font-size: 36px; font-weight: bold;">Produk <span style="color: #ff6b4a;">Terbaru</span></h2>
            </div>

            <div class="row">
                @foreach ($products as $row)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div style="background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: 0.3s;">
                        <div style="position: relative;">
                            <img src="{{ asset('products/' . $row->image) }}" alt="{{ $row->name }}" style="width: 100%; height: 250px; object-fit: cover;">
                            <a href="{{ url('/product/' . $row->slug) }}" style="position: absolute; bottom: 10px; right: 10px; background: #ff6b4a; color: white; padding: 8px 12px; border-radius: 20px; font-size: 14px; text-decoration: none;">
                                <i class="ti-shopping-cart"></i> Beli
                            </a>
                        </div>
                        <div style="padding: 15px;">
                            <p style="margin: 0; color: #6c757d; font-size: 14px;">{{ $row->category->name }}</p>
                            <h5 style="font-size: 18px; font-weight: bold; margin-top: 5px;">{{ $row->name }}</h5>
                            @if ($row->stock == 0)
                                <p style="color: red; font-size: 14px;">Stok Habis</p>
                            @endif
                            @if ($row->price_discount == 0)
                                <p style="font-size: 16px; color: #28a745; margin-top: 8px;">Rp. {{ number_format($row->price, 0, ',', '.') }}</p>
                            @else
                                <p style="text-decoration: line-through; color: red; font-size: 14px;">Rp. {{ number_format($row->price, 0, ',', '.') }}</p>
                                <p style="font-size: 16px; color: #28a745;">Rp. {{ number_format($row->price_discount, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</main>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    <script>
        // Jika terdapat pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3500 // Tampilkan selama 1.5 detik, sesuaikan dengan kebutuhan Anda
            });
        @endif
    </script>
@endsection
