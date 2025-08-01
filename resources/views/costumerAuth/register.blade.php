@extends('layouts.layout')

@section('title')
    Register
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/vendors/linericon/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/nouislider/nouislider.min.css")}}">
@endsection

@section('section-login')
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Register</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

<section class="section-margin" style="min-height: 100vh; background: #f4f4f4; padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center shadow-lg" style="background: #fff; border-radius: 12px; overflow: hidden;">
            <div class="col-lg-5 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff, #34495e); color: #fff; padding: 40px;">
                <div class="text-center">
                    <img src="{{ asset('dist/img/mesin.png') }}" alt="Motor Icon" style="width: 100px; margin-bottom: 20px;">
                    <h4>Sudah punya akun?</h4>
                    <p>Masuk dan kelola pesanan Anda dengan mudah.</p>
                    <a href="{{ route('costumer.login') }}" class="btn btn-light mt-3" style="color: #34495e;">Login Sekarang</a>
                </div>
            </div>

            <div class="col-lg-7 p-5">
                <h3 class="text-center mb-4" style="font-weight: bold; color: #2c3e50;">Buat Akun Baru</h3>
                <form method="POST" action="{{ route('costumer.register.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="phone_number" class="form-control" placeholder="Nomor Telepon" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="address" class="form-control" placeholder="Alamat Lengkap" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <select class="form-control" name="province_id" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="form-control" name="citie_id" required>
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="form-control" name="district_id" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn w-100" style="background-color: #e74c3c; color: white; font-weight: bold;">Daftar Sekarang</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script type="text/javascript">
        $('#province_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){

                    $('#city_id').empty()
                    $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })

        $('#city_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { city_id: $(this).val() },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })
    </script>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        function validatePassword() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("Confirm password harus sama dengan password");
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }

        passwordInput.addEventListener('change', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);
    </script>

@endsection

