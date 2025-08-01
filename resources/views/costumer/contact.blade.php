@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}">
@endsection

@section('title')
    Kontak
@endsection

@section('kontak')
    active
@endsection

@section('main')
    <!-- ================ start banner area ================= -->
    <!-- <section class="blog-banner-area" id="contact">
                <div class="container h-100">
                    <div class="blog-banner">
                        <div class="text-center">
                            <h1>Contact Us</h1>
                            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                  </nav>
                        </div>
                    </div>
            </div>
            </section> -->
    <!-- ================ end banner area ================= -->

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small">
        <div class="container">
            <h1>Kontak Kami</h1>
            <div class="d-none d-sm-block mb-5 pb-4">
                <div id="map" style="height: 420px;">
                    <iframe style="width: 100%; height: 100%;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.042756717545!2d106.5294265!3d-6.1708931!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420076990177e9%3A0x260ff2a387d367f0!2sRuko%20Pasar%20Kemis!5e0!3m2!1sid!2sid!4v1722510000000!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>


            <div class="row">
                <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Pasar Kemis</h3>
                            <p>Ruko Pasar Kemis</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:454545654">085770987828</a></h3>
                            <p>Setiap Hari</p>
                        </div>
                    </div>
                    {{-- <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:support@colorlib.com">support@colorlib.com</a></h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-8 col-lg-9">
                    <form action="#/" class="form-contact contact_form" action="contact_process.php" method="post"
                        id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        placeholder="Enter Subject">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5"
                                        placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection

@section('js')
    <script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    {{-- <script type="text/javascript">
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

        $('#courier').on('change', function() {
            $('#service').empty()
            $('#service').append('<option value="">Loading...</option>')
            $.ajax({
                url:"{{ route('home.cekongkir') }}",
                type: "POST",
                data: {
                        _token:              $("meta[name='csrf-token']").attr("content"),
                        city_origin:         $('input[name=city_origin]').val(),
                        city_destination:    $('select[name=city_destination]').val(),
                        courier:             $('select[name=courier]').val(),
                        weight:              $('#weight').val(),
                    },

                success: function(response){
                    $('#service').empty();
                    $('#service').append('<option value="">Pilih service</option>')
                    $.each(response[0]['costs'], function (key, value) {
                        $('#service').append('<option>'+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong>, '+value.cost[0].value+', ('+value.cost[0].etd+' hari)</option>')
                    });
                }
            });
        })

        $('#service').on('change', function() {
            let split = $(this).val().split(',')
            $('#ongkir').text('Ongkir : Rp. ' + split[1])
            $('#resi').text('Perkiraan waktu sampai : ' + split[2])

            let subtotal = "{{ $subtotal }}"
            let total = parseInt(subtotal) + parseInt(split[1])
            $('#total').text('Rp. ' + total)
            $('#subtotal').append('<input type="text" name="subtotal" value="'+total+'" disabled required>')
        })

    </script>     --}}
@endsection
