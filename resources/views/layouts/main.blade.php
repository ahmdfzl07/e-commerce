{{-- @php
    use App\Models\Notification;
    $user_check = Auth::user();
    $notification = Notification::getTotal($user_check->id, Notification::STATUS_UNREAD);
    $listNotification = [];
    if ($notification) {
        $listNotification = Notification::latest()
            ->where(['userId' => $user_check->id, 'status' => Notification::STATUS_UNREAD])
            ->take(10)
            ->get();
    }
@endphp --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token --->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>H. ILI MOTOR</title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo.png') }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="Stylesheet" href="{{ asset('plugins/jquery-ui/css/jquery-ui.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- MomentJS (required by daterangepicker) -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- DateRangePicker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <style>
        @keyframes hdGlow {
            0% {
                box-shadow: 0 0 8px rgba(59, 130, 246, 0.2);
            }

            50% {
                box-shadow: 0 0 18px rgba(59, 130, 246, 0.6);
            }

            100% {
                box-shadow: 0 0 8px rgba(59, 130, 246, 0.2);
            }
        }

        .main-header.navbar,
        .hd-footer {
            animation: hdFadeIn 0.8s ease-out;
        }

        /*
        .main-header.navbar:hover,
        .hd-footer:hover {
            animation: hdGlow 1.5s ease-in-out infinite;
        } */

        @keyframes sidebarSlideIn {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes sidebarGlow {
            0% {
                box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
            }

            50% {
                box-shadow: 0 0 12px rgba(74, 144, 226, 0.6);
            }

            100% {
                box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
            }
        }

        .main-sidebar {
            animation: sidebarSlideIn 0.6s ease-out;
            transition: box-shadow 0.3s ease;
        }

        .nav-item.active {
            animation: sidebarGlow 1.5s ease-in-out infinite;
        }


        .nav.nav-sidebar .nav-item.active .nav-link,
        .nav.nav-sidebar .nav-item .nav-link:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }

        .nav.nav-sidebar .nav-item .nav-link {
            background: linear-gradient(145deg, #0d2144, #091f4a);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.25), -2px -2px 6px rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.35s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .nav.nav-sidebar .nav-item .nav-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 180%;
            height: 0;
            background: rgba(255, 255, 255, 0.06);
            transform: translate(-50%, -50%) rotate(45deg);
            transition: all 0.6s ease;
            z-index: 0;
        }

        .nav.nav-sidebar .nav-item .nav-link:hover::before {
            height: 300%;
        }

        .nav.nav-sidebar .nav-item .nav-link:hover {
            box-shadow: 0 0 15px rgba(14, 35, 65, 0.6), inset 0 0 4px rgba(255, 255, 255, 0.1);
            transform: translateX(4px) scale(1.02);
            color: #ffffff;
            z-index: 1;
        }

        .nav.nav-sidebar .nav-item {
            animation: navFadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        .nav.nav-sidebar .nav-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .nav.nav-sidebar .nav-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .nav.nav-sidebar .nav-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes navFadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .dropbtn {
            /* background-color: #3498DB;
          color: white; */
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropup {
            position: relative;
            display: inline-block;
        }

        .dropup-content {
            display: none;
            position: absolute;
            bottom: 50px;
            z-index: 1;
        }

        .dropup-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropup:hover .dropup-content {
            display: block;
        }

        .close-popup {
            position: relative;
            top: 24px;
        }

        .modal-popup {
            background: none !important;
            border: 0 !important;
        }

        .dialog-popup {
            margin: 2rem auto !important;
        }

        .badge-xl {
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease-in-out;
        }

        .badge-xl:hover {
            transform: translateY(-2px);
        }

        .main-sidebar {
            background: linear-gradient(180deg, #2173c0 0%, #132445 100%);
            border-right: 1px solid #005ce5;
        }

        .main-sidebar a {
            font-size: 15px;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .main-sidebar a:hover {
            box-shadow: 0 2px 8px rgba(18, 48, 107, 0.4);
        }

        .main-sidebar .nav-item.active {
            box-shadow: inset 3px 0 0 #112d4c, 0 2px 6px rgba(146, 229, 3, 0.342);
            font-weight: 600;
        }

        .main-sidebar .brand-link {
            font-size: 1.2rem;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .main-sidebar .nav-icon {
            font-size: 1.1rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .main-sidebar .nav-icon:hover {
            transform: scale(1.1);
        }

        .main-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .main-sidebar::-webkit-scrollbar-thumb {
            background-color: #0e253f;
            border-radius: 10px;
        }

        .info {
            background: linear-gradient(145deg, #182947, #22345a);
            padding: 15px;
            margin: 15px;
            border-radius: 10px;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        .info a.d-block {
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 10px;
            display: block;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .info a.d-block:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .info a.nav-link {
            margin-top: 10px;
            padding: 8px 10px;
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            color: #ffffff;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .info a.nav-link:hover {
            background-color: #0f2a5c;
            color: #ffffff;
        }

        .info a.nav-link p {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info a.nav-link p::before {
            content: "⎋";
            font-size: 1rem;
        }

        nav.mt-2 {
            padding-top: 5px;
        }

        .nav.nav-pills.nav-sidebar.flex-column {
            gap: 4px;
        }

        .nav.nav-pills.nav-sidebar.flex-column>.nav-item {
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .nav.nav-pills.nav-sidebar.flex-column>.nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            transform: translateX(2px);
        }

        .nav.nav-pills.nav-sidebar.flex-column>.nav-item>.nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            font-size: 15px;
            border-radius: 6px;
            color: #cde2ff;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .nav.nav-pills.nav-sidebar.flex-column>.nav-item>.nav-link:hover {
            background-color: #0f2a5c;
            color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .nav.nav-pills.nav-sidebar.flex-column .nav-icon {
            margin-right: 10px;
            color: #a4c6f8;
        }

        .form-inline {
            margin-top: 15px;
            padding: 10px;
            background: linear-gradient(145deg, #16243e, #1d283e);
            /* Gradient background untuk konsistensi */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(247, 80, 80, 0.2);
        }

        .form-control-sidebar {
            background-color: #ff0000;
            border: 1px solid #da3d3d;
            color: #f80303;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.3s ease, border 0.3s ease;
        }

        .form-control-sidebar:focus {
            background-color: #646564;
            border-color: hsl(211, 58%, 11%);
            box-shadow: 0 0 5px #063060;
        }

        .btn-sidebar:hover {
            background-color: #111e38;
            transform: scale(1.05);
        }

        .input-group-append .btn-sidebar i {
            font-size: 1.1rem;
        }

        .main-header.navbar {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .main-header.navbar:hover {
            background: linear-gradient(135deg, #dcdedf, #dcdedf);
        }

        .navbar-nav .nav-link {
            color: #37aef3;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 12px 15px;
            border-radius: 8px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #f34320;
            transform: scale(1.1);
        }

        .navbar-nav .nav-link i {
            font-size: 1.5rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover i {
            color: hsl(220, 38%, 13%);
            transform: scale(1.2);
        }

        .navbar-search-block {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background-color: rgba(19, 26, 41, 0.9);
            border-radius: 8px;
            padding: 5px 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .form-control-navbar {
            border-radius: 6px;
            background-color: #f32323;
            border: 1px solid #e83e3e;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control-navbar:focus {
            box-shadow: 0 0 8px rgba(246, 249, 251, 0.7);
        }

        .navbar-search-block .input-group .btn {
            background-color: #a2aaaf;
            color: rgb(215, 210, 210);
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .navbar-search-block .input-group .btn:hover {
            background-color: #bdc0c4;
        }

        .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .navbar-nav .nav-item .badge {
            background-color: #eb1414;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            padding: 5px 10px;
            margin-top: -10px;
            margin-right: -10px;
        }

        .navbar-nav .nav-item a.nav-link[data-widget="fullscreen"] {
            color: #b3b2b2;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-item a.nav-link[data-widget="fullscreen"]:hover {
            color: #091d25;
        }

        /* .hd-footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: #1e40af;
            padding: 24px 32px;
            border-top: 2px solid rgba(200, 200, 200, 0.3);
            font-size: 15px;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
            transition: all 0.4s ease;
            border-radius: 20px 20px 0 0;
            animation: fadeUp 1s ease;
        }

        .hd-footer .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .hd-footer a {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            display: inline-block;
            padding: 6px 4px;
            transition: all 0.3s ease-in-out;
        }

        .hd-footer a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #1d4ed8, #60a5fa);
            border-radius: 4px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .hd-footer a:hover {
            color: #0c3acc;
            transform: translateY(-2px) scale(1.05);
            text-shadow: 0 0 8px rgba(59, 130, 246, 0.4);
        }

        .hd-footer a:hover::after {
            transform: scaleX(1);
        } */

        @media (max-width: 576px) {
            .hd-footer .footer-content {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }

        .input-group input.form-control {
            transition: all 0.3s ease;
            box-shadow: none;
        }

        .input-group input.form-control:focus {
            outline: none;
            border-color: #1c242e;
            box-shadow: 0 0 8px rgba(27, 35, 45, 0.6);
        }

        .input-group-append .btn {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .input-group-append .btn:hover {
            background-color: #1a212a;
            transform: scale(1.05);
        }

        .input-group-append .btn:hover i {
            animation: spin 0.6s linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .input-group input.form-control {
            transition: all 0.3s ease;
            box-shadow: none;
            transform: scale(1);
        }

        .input-group input.form-control:focus {
            outline: none;
            border-color: #1a222d;
            box-shadow: 0 0 10px rgba(20, 24, 31, 0.6);
            transform: scale(1.02);
        }

        .input-group input.form-control::placeholder {
            color: #aaa;
            transition: all 0.3s ease;
        }

        .input-group input.form-control:focus::placeholder {
            transform: translateX(5px);
            opacity: 0;
        }

        .input-group-append .btn {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .input-group-append .btn:hover {
            background-color: #181f29;
            transform: scale(1.05);
        }

        .input-group-append .btn:hover i {
            animation: spin 0.6s linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    @yield('page-styles')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars fa-2x"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link text-lg">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
              <a target="_blank" href="https://adminlte.io/docs/3.1/" class="nav-link">Online Docs</a>
            </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search fa-2x"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell fa-2x"></i>
                        <span class="badge badge-danger navbar-badge badge-xl 3d-badge"
                            id="notificationBadge">{{ $notification }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $notification }} Notifications</span>
                        <div class="dropdown-divider"></div>
                        @foreach ($listNotification as $i => $val)
                            <a href="{{ url('/notification/show', $val->id) }}" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>{{ $val->subject }}
                                <span class="float-right text-muted text-sm">{{ $val->type }}</span>
                            </a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/notification') }}" class="dropdown-item dropdown-footer">See All
                            Notifications</a>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt fa-2x"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" style="opacity: .8; width:100%;"
                    height="100">
                {{-- <span class="brand-text font-weight-light">H. ILI MOTOR</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('storage/users/' . Auth::user()->profile_image) }}"
                            class="img-circle elevation-2" alt="User Image" style="margin-top: 15px;">

                    </div>
                    <div class="info">
                        <!-- User's Name -->
                        <a href="#" class="d-block">
                            &nbsp;&nbsp;&nbsp; {{ isset($user_check) ? Auth::user()->name : '' }}
                        </a>
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>


                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}" class="nav-link">
                                &nbsp; <i class="fas fa-home"></i> &nbsp;
                                <p>Home</p>
                            </a>
                        </li>
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-alt"></i>
                                    <p>Kategori<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('category.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Kategori</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Produk<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('product.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Produk</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cart-plus"></i>
                                    <p>Pesanan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('order.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Proses Pesanan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cart-plus"></i>
                                    <p>Pesanan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('pesanan.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pesanan Anda</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Laporan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('laporan.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Laporan Data</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        {{-- @php
                            $userRole = Auth::user()->roles->pluck('name')->implode(',');
                        @endphp --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://adminlte.io">H. ILI MOTOR</a>.</strong>

            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- MODAL SWEETALERT2 -->
    <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Success Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- MODAL SHOW --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mr-3 spinner spinner-dark spinner-right pr-15"
                            wait-class="spinner spinner-dark spinner-right pr-15">
                            Loading
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL SHOW --}}

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/signature.js') }}"></script>
    <script src="{{ asset('js/soundmanager2-nodebug-jsmin.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>






    <!-- Page specific script -->
    <script>
        $(function() {
            soundManager.url = "{{ asset('js/swf/') }}";
            soundManager.onready(function() {
                var delay = $('#delay').val();
                cek_notif();
            })

            function cek_notif() {
                var sendURL = "{{ url('/notification/cek_notif') }}";

                $.ajax({
                    url: sendURL,
                    dataType: "json",
                    success: function(data) {
                        if (data.notification.length > 0) {
                            playthemusic();
                            console.log(data.notification.length);

                            // for(var i=0; i < data.notification.length; i++){
                            // console.log(data.notification[i]);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                // didOpen: (toast) => {
                                //     toast.onmouseenter = Swal.stopTimer;
                                //     toast.onmouseleave = Swal.resumeTimer;
                                // }
                            });
                            Toast.fire({
                                icon: "info",
                                title: '<label>PEMBERITAHUAN</label><br><label class="notify-me">Ada Notifikasi Baru Untuk Anda !</label>',
                                position: 'top' //Menyesuaikan posisi ke tengah atas
                            })
                            // }

                        } else {}

                    },
                    async: false,

                });
                setTimeout(function() {
                    cek_notif();
                }, 30000);
            }

            function playthemusic() {
                obj = new Array();
                nilaiString = 'notification';
                daftarSuara = nilaiString.split("-");
                obj = buatSuara(daftarSuara);
                obj[0].play();
            }

            function buatSuara(daftarSuara) {
                var sendURL = "{{ asset('js/') }}";
                i = 0;
                j = 0;
                while (i < daftarSuara.length) {
                    j = i.toString();
                    if (i != daftarSuara.length - 1) {
                        obj[i] = soundManager.createSound({
                            id: j,
                            volume: 100,
                            url: sendURL + daftarSuara[i] + '.mp3',
                            onfinish: function() {
                                var next = parseInt(this.sID) + 1;
                                obj[next].play();
                                this.destruct();
                            }
                        })
                    } else {
                        obj[i] = soundManager.createSound({
                            id: i.toString(),
                            volume: 100,
                            url: sendURL + '/' + daftarSuara[i] + '.mp3',
                            onfinish: function() {
                                this.destruct();
                            }
                        })
                    }
                    i++;
                }
                return obj;
            }

            $('.swal2-popup').on('click', function() {
                var showURL = "{{ url('/notification') }}";
                window.location.replace(showURL);
            });


            function getThousandSeparator(val) {
                return Intl.NumberFormat('id-ID', {
                    maximumFractionDigits: 3
                }).format(val);
            }
            $('.number').keyup(function(e) {
                var n = $(this).val().replace(/[^\d,]/g, '');
                $(this).val(getThousandSeparator(n));
            });
            //Date picker
            $('.one-datepicker').datetimepicker({
                format: 'DD-MM-YYYY',
                defaultDate: moment()
            });
            $('#fulldatetimepicker').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Date range picker
            $('.multi-datepicker').daterangepicker({
                format: 'DD-MM-YYYY'
            });

            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder: 'Silahkan Dipilih',
                allowClear: true,
            });
            $(".date-picker").flatpickr({
                dateFormat: "d-m-Y",
            });
            $(".month-picker").flatpickr({
                dateFormat: "F Y",
            });
            //Contoh Select2 Ajax Ketika on Select
            $('.ajax_select2').select2({}).on('select2:select', function(event) {
                var selected_value = event.params.data.id;
                $.ajax({
                    url: '{{ url('post-research-ajax-select2') }}',
                    data: {
                        vals: selected_value,
                        _token: "<?php echo csrf_token(); ?>"
                    },
                    type: 'post',
                    success: function(output) {
                        $('#nama').val(output.produk);
                        $('#warna').val(output.warna);
                        $('#qty').val(output.qty);
                    }
                });
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // $(".datatable").DataTable({
            //     scrollCollapse: true,
            //     "pageLength": 10,
            //     "responsive": false,
            //     "lengthChange": false,
            //     "autoWidth": false,
            //     //"buttons": ["excel", "pdf"]
            // }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
            //Kunjungan Pelanggan
            $(".datatablee").DataTable({
                scrollCollapse: true,
                "pageLength": 10,
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                //"buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
            //Update
            $(".datatable").DataTable({
                scrollCollapse: true,
                pageLength: 10,
                responsive: false,
                lengthChange: false,
                autoWidth: false,
                stateSave: true,
                //"buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)')

            $(".datatablewo").DataTable({
                scrollCollapse: true,
                pageLength: 10,
                responsive: false,
                lengthChange: false,
                autoWidth: false,
                stateSave: true,
                paging: true, // Menonaktifkan pagination
                //"buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');


            $('.datatableAutoNumeric').DataTable({
                scrollCollapse: true,
                "pageLength": 10,
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "stateSave": true,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).html(iDisplayIndexFull + 1);
                }
            });

            $(document).ready(function() {
                $('.datatableAutoNumericc').DataTable({
                    scrollCollapse: true,
                    "pageLength": 10,
                    "responsive": false,
                    "lengthChange": false,
                    "autoWidth": false,
                    "stateSave": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('td:eq(0)', nRow).html(iDisplayIndexFull + 1); // Number rows
                    }
                });
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if ($success = Session::get('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ $success }}'
                });
            @endif

            @if ($error = Session::get('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                });
            @endif

            $('#myModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);
                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        })
    </script>
    <script>
        (function() {
            // "use strict";

            var cookieName = "pop";
            var cookieLifetime = 1;


            var _setCookie = function(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 1 * 60 * 60 * 1000)); // expires dalam 1 jam
                // d.setTime(d.getTime() + (exdays * 1 * 60000)); //tes untuk 1 menit
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            };


            var _getCookie = function(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            };

            var _shouldShowPopup = function() {
                if (_getCookie(cookieName)) {
                    return false;
                } else {
                    return true;
                }
            };

            if (_shouldShowPopup()) {
                $('#PopUpPromo').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true,
                });
            }

            $('#modalPopupClose').on('click', function() {
                _setCookie(cookieName, 1, cookieLifetime);
            });

        })();
    </script>

    @yield('page-scripts')

    <style type="text/css">
        .loader-div {
            display: none;
            position: fixed;
            margin: 0px;
            padding: 0px;
            right: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 30001;
            opacity: 0.5;
        }

        .loader-img {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>

    <div class="loader-div">
        <img class="loader-img" src="{{ asset('dist/img/loading.gif') }}" style="height: 120px;width: auto;" />
    </div>

</body>

</html>
