<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SEBELAH GUDANG - @yield('title')</title>
    {{-- <link rel="icon" href="img/Fevicon.png" type="image/png"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}">

    <!-- Add these links in the head section of your HTML file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    @yield('css')

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                            @if (Auth::guard('costumer')->check())
                                <li class="nav-item @yield('index')"><a class="nav-link"
                                        href="{{ route('home.index') }}">Home</a></li>
                                <li class="nav-item @yield('produk')"><a class="nav-link"
                                        href="{{ route('home.product') }}">Produk</a></li>
                                <li class="nav-item @yield('kontak')"><a class="nav-link" href="/contact">Kontak</a>
                                </li>
                            @else
                                <li class="nav-item @yield('index')"><a class="nav-link"
                                        href="{{ route('front.index') }}">Home</a></li>
                                <li class="nav-item @yield('produk')"><a class="nav-link"
                                        href="{{ route('front.product') }}">Produk</a></li>
                                {{-- <li class="nav-item @yield('full_custom')"><a class="nav-link" href="{{ route('front.full_custom') }}">SEBELAH GDNG</a></li> --}}
                                <li class="nav-item @yield('kontak')"><a class="nav-link" href="/contact">Kontak</a>
                                </li>
                            @endif
                        </ul>

                        <ul class="nav-shop">

                            @if (Auth::guard('costumer')->check())
                                <li class="nav-item">
                                    <button>
                                        <a href="{{ route('home.orderdetail') }}">
                                            <i class="ti-list"></i>
                                            <?php
                                            $pendingOrdersCount = App\Models\Order::where('customer_id', Auth::guard('costumer')->user()->id)
                                                ->where('status', 0)
                                                ->count();
                                            ?>
                                            @if ($pendingOrdersCount > 0)
                                                <span class="nav-shop__circle">{{ $pendingOrdersCount }}</span>
                                            @endif
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item"><button><a href=" {{ route('home.list_cart') }} "><i
                                                class="ti-shopping-cart"></i></a><span class="nav-shop__circle">
                                            {{ $cart->count() }} </span></button> </li>

                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true"
                                        aria-expanded="false">{{ Auth::guard('costumer')->user()->name }}</a>

                                    <form method="POST" action="{{ url('costumer/logout-customer') }}">
                                        @csrf
                                        <ul class="dropdown-menu">

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('costumer.profile') }}">Profil</a>
                                                <a class="nav-link" href="{{ url('costumer/logout-customer') }}"
                                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                                    {{ __('Logout') }}</a>
                                            </li>
                                        </ul>
                                    </form>
                                </li>
                    </div>
                @else
                    {{-- <li class="nav-item"><button><i class="ti-list"></i></button></li>
                <li class="nav-item"><button><a href="cart"><i class="ti-shopping-cart"></i></a></span></button> </li> --}}
                    <li class="nav-item"><a class="button button-header" href="{{ route('costumer.login') }}">Login</a>
                    </li>
                    @endif
                    </ul>
                </div>
        </div>
        </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->
    @yield('section-login')

    @yield('main')


    <!--================ Start footer Area  =================-->
    <footer class="footer">
        <div class="footer-area">
            <div class="container">
                <div class="row section_gap">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title large_title">Lokasi</h4>
                            <iframe style="width: 100%; height: 40%;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.020094559673!2d106.407704!3d-6.2610831000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420562deddf035%3A0xe83d7170f0bbe651!2sSEBELAH%20GUDANG%20CAFE!5e0!3m2!1sid!2sid!4v1751288408332!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Kategori</h4>
                            <ul class="list">
                                <li><a href="#">Coffee</a></li>
                                <li><a href="#">Non Coffee</a></li>
                                <li><a href="#">Makanane</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Kontak</h4>
                            <p>081398446979</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row d-flex">
                    <p class="col-lg-12 footer-text text-center">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Sebelah Gudang <i class="fa fa-heart"
                            aria-hidden="true"></i> <a href="#" target="_blank"></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->
    <script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/skrollr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/mail-script.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Add these scripts at the end of the body section of your HTML file -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.slick-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });
        });
    </script>

    @yield('js')
</body>

</html>
