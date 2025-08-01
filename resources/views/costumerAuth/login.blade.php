@extends('layouts.layout')

@section('title')
    Login
@endsection

@section('css')
    <!-- Plugin CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/css/nice-select.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css" />
@endsection

@section('section-login')
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Login / Register</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

 <section class="login_box_area section-margin" style="background: url('{{ asset('costumer/img/bg-motor.jpg') }}') no-repeat center center; background-size: cover; padding: 100px 0;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="background-color: rgba(255, 255, 255, 0.9); border-radius: 12px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">

            <!-- Logo + Daftar -->
            <div class="col-lg-6 d-none d-lg-block text-center" style="border-right: 1px solid #ccc;">
                <img src="{{ asset('dist/img/mesin2.jpeg') }}" alt="Logo" style="max-width: 180px; margin-bottom: 20px;">
                <h4 style="color: #2c3e50;">Baru di situs kami?</h4>
                <p style="color: #7f8c8d;">Daftar sekarang dan nikmati berbagai fitur menarik untuk kebutuhan sparepart motor Anda.</p>
                <a href="{{ route('costumer.register') }}" style="display: inline-block; margin-top: 15px; padding: 10px 25px; background-color: #e67e22; color: white; border-radius: 25px; text-decoration: none;">
                    Buat Akun
                </a>
            </div>

            <!-- Form Login -->
            <div class="col-lg-6 col-md-10">
                <div style="padding: 30px;">
                    <h3 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">Login Pelanggan</h3>
                    <form class="row login_form" method="POST" action="{{ route('costumer.login.post') }}">
                        @csrf
                        <div class="col-md-12 form-group" style="margin-bottom: 20px;">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required style="padding: 12px 20px; border-radius: 25px; border: 1px solid #ccc;">
                        </div>
                        <div class="col-md-12 form-group" style="margin-bottom: 20px;">
                            <input type="password" class="form-control" name="password" placeholder="Password" required style="padding: 12px 20px; border-radius: 25px; border: 1px solid #ccc;">
                        </div>
                        <div class="col-md-12 form-group" style="margin-bottom: 20px;">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember"> Remember Me</label>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" style="width: 100%; padding: 12px; background-color: #e74c3c; border: none; border-radius: 25px; color: white; font-weight: bold;">Log In</button>
                            <div style="margin-top: 10px; text-align: center;">
                                <a href="#" style="color: #7f8c8d; text-decoration: none;">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- SweetAlert Flash -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    </script>
@endsection

@section('js')
    <!-- jQuery + Plugin JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.30/skrollr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxchimp/1.3.0/jquery.ajaxchimp.min.js"></script>

    <!-- Custom main.js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
