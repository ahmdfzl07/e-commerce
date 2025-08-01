@extends('layouts.layout')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}">
@endsection

@section('title')
    Checkout
@endsection

@section('main')
    <!-- ================ start banner area ================= -->
    <!-- <section class="blog-banner-area" id="category">
            <div class="container h-100">
                <div class="blog-banner">
                    <div class="text-center">
                        <h1>Checkout Produk</h1>
                        <nav aria-label="breadcrumb" class="banner-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section> -->
    <!-- ================ end banner area ================= -->


    <!--================Checkout Area =================-->
 <section style="padding: 60px 0; background: #f5f8fa; font-family: 'Segoe UI', sans-serif;">
  <div style="max-width: 1140px; margin: auto;">
    <h1 style="font-size: 32px; font-weight: 600; margin-bottom: 30px; color: #333;">Checkout Produk</h1>

    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
      <!-- Form Area -->
      <div style="flex: 2; min-width: 300px; background: white; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 20px; color: #444;">Detail Pembayaran</h3>

        @if (session('error'))
          <div style="background: #f8d7da; padding: 10px; border-radius: 6px; color: #721c24; margin-bottom: 20px;">
            {{ session('error') }}
          </div>
        @endif

        <form action="{{ route('home.checkoutproses') }}" method="post">
          @csrf
          <input type="hidden" name="invoice" value="{{ Str::random(4) . '-' . time() }}">
          <input type="hidden" name="customer_id" value="{{ Auth::guard('costumer')->user()->id }}">

          <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <input type="text" name="customer_name" placeholder="Nama Lengkap"
              value="{{ Auth::guard('costumer')->user()->name }}"
              style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>

            <input type="text" name="customer_phone" placeholder="Nomor Telepon"
              value="{{ Auth::guard('costumer')->user()->phone_number }}"
              style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
          </div>

          <div style="margin-bottom: 20px;">
            <input type="text" name="customer_address" placeholder="Alamat Lengkap"
              value="{{ Auth::guard('costumer')->user()->address }}"
              style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
          </div>

          <input type="hidden" name="district_id" value="{{ Auth::guard('costumer')->user()->district_id }}">
          <input type="hidden" name="citie_id" value="{{ Auth::guard('costumer')->user()->citie_id }}">
          <input type="hidden" name="subtotal" value="{{ $subtotal }}">
          <input type="hidden" name="status" value="0">
      </div>

      <!-- Order Summary -->
      <div style="flex: 1; min-width: 280px; background: white; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h2 style="font-size: 24px; margin-bottom: 20px; color: #444;">Pesanan Anda</h2>
        <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
          <li style="display: flex; justify-content: space-between; font-weight: 600; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 10px;">
            <span>Produk</span><span>Total</span>
          </li>
          @foreach ($cart as $row)
          <li style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>{{ $row->product->name }} x {{ $row->qty }}</span>
            <span>Rp. {{ number_format($row->cart_price * $row->qty) }}</span>
          </li>
          @endforeach
        </ul>

        <ul style="list-style: none; padding: 0; margin-bottom: 30px;">
          <li style="display: flex; justify-content: space-between; font-weight: bold;">
            <span>Subtotal</span><span>Rp. {{ number_format($subtotal) }}</span>
          </li>
        </ul>

        <button type="submit" style="width: 100%; padding: 12px; background: #28a745; color: white; font-weight: bold; border: none; border-radius: 6px; font-size: 16px;">
          Bayar Pesanan
        </button>
      </div>
    </form>
    </div>
  </div>
</section>

    <!--================End Checkout Area =================-->
@endsection

{{-- @section('js')
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


            let subtotal = "{{ $subtotal }}"
            let total = parseInt(subtotal) + parseInt(split[1])
            $('#total').text('Rp. ' + total)
            $('#cost').append('<option value="'+total+'">'+total+'</option>')
            $('#shipping').append('<option value="'+split[1]+'">'+split[1]+'</option>')
            // $('#subtotal').append('<input type="text" class="form-control" name="shipping" value="'+split[1]+'" disabled required>')
            // $('#resi').append('<input type="text" class="form-control" name="cost" value="'+total+'" disabled required>')
        })

    </script>
@endsection --}}
