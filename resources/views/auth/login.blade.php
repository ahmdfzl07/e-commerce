@extends('layouts.auth')

@section('content')
    <style>
        body {
            /* background-image: url('{{ asset('dist/img/logo.png') }}'); */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: backgroundMove 15s infinite ease-in-out;
        }

        @keyframes backgroundMove {
            0% {
                background-position: center;
            }

            50% {
                background-position: top right;
            }

            100% {
                background-position: center;
            }
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(8px);
            z-index: -1;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            width: 100%;
            opacity: 0;
            transform: translateY(-30px);
            animation: slideIn 0.8s ease-out forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header h1 {
            font-size: 36px;
            font-weight: 700;
            color: #0056b3;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .login-box-msg {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-in-out 0.5s;
        }

        .input-group {
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .input-group:hover {
            transform: scale(1.05);
        }

        .input-group input {
            border-radius: 30px;
            padding: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            border-radius: 30px;
            background-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .icheck-primary input:checked~label {
            color: #007bff;
        }

        .icheck-primary input:focus~label {
            color: #0056b3;
        }

        .icheck-primary input:checked~label::before {
            border-color: #007bff;
        }

        .img-responsive {
            animation: fadeInImage 1s ease-in-out;
        }

        .logo-zoom {
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            animation: fadeInImage 1.5s ease-in-out forwards;
        }

        .logo-zoom:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }

        @keyframes fadeInImage {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInERP {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .erp {
            opacity: 0;
            display: inline-block;
            animation: fadeInERP 2s ease-in-out 2s forwards;
        }

        .animate-text .letter {
            opacity: 0;
            display: inline-block;
            animation: fadeInLetter 0.5s ease-in-out forwards;
        }

        @keyframes fadeInLetter {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .animate-text .letter:nth-child(1) {
            animation-delay: 0s;
        }

        .animate-text .letter:nth-child(2) {
            animation-delay: 0.1s;
        }

        .animate-text .letter:nth-child(3) {
            animation-delay: 0.2s;
        }

        .animate-text .letter:nth-child(4) {
            animation-delay: 0.3s;
        }

        .animate-text .letter:nth-child(5) {
            animation-delay: 0.4s;
        }

        .animate-text .letter:nth-child(6) {
            animation-delay: 0.5s;
        }

        .animate-text .letter:nth-child(7) {
            animation-delay: 0.6s;
        }

        .animate-text .letter:nth-child(8) {
            animation-delay: 0.7s;
        }

        .animate-text .letter:nth-child(9) {
            animation-delay: 0.8s;
        }

        .animate-text .letter:nth-child(10) {
            animation-delay: 0.9s;
        }

        .animate-text .letter:nth-child(11) {
            animation-delay: 1s;
        }

        .animate-text .letter:nth-child(12) {
            animation-delay: 1.1s;
        }

        .login-box-msg {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1.5s ease-in-out forwards, scaleIn 1s ease-in-out 1s;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0.8);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

   <div class="login-box" style="max-width: 400px; margin: auto; padding-top: 50px;">
    <img class="img-responsive text-center logo-zoom"
        style="display:block;margin:0 auto 20px auto; max-height:80px"
        src="{{ asset('dist/img/logo.png') }}" alt="Logo Toko Sparepart">

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-center bg-dark text-white">
            <h3 style="font-family: 'Orbitron', sans-serif;">Login Toko Sparepart</h3>
            <p class="mb-0" style="font-size: 0.9rem;">Silakan masuk untuk melanjutkan</p>
        </div>

        <div class="card-body bg-light">
            <form method="POST" action="{{ route('proses_login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email Anda"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text bg-dark text-white">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Kata Sandi"
                        name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text bg-dark text-white">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill px-5">
                            Masuk
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-footer text-muted text-center small">
            © {{ date('Y') }} H. Ili Motor – Sparepart & Servis Motor
        </div>
    </div>
</div>

@endsection
