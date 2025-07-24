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

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <!-- Logo area -->
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover text-center">
                            <img src="{{ asset('costumer/img/logo.png') }}" alt="Logo" style="max-width: 200px;">
                            <h4>Baru di situs web kami?</h4>
                            <p>Daftar sekarang dan nikmati berbagai fitur menarik.</p>
                            <a class="button button-account" href="{{ route('costumer.register') }}">Buat Akun</a>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in</h3>
                        <form class="row login_form" method="POST" action="{{ route('costumer.login.post') }}">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="f-option2">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-login w-100">Log In</button>
                                <a href="#">Forgot Password?</a>
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
