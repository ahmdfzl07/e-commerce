@php
    $user_check = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SEBELAH GUDANG</title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/intec-favicon.png') }}" />

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
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border-color: #006fe6;
            color: #464141 !important;
            padding: 0 10px;
            margin-top: 0.31rem;
        }
    </style>

    @yield('page-styles')
</head>

<body class="hold-transition login-page" style="justify-content: normal;">

    <!-- Start counter -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/vendor_counter/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ url('') }}/vendor_counter/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/vendor_counter/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/vendor_counter/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/vendor_counter/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/vendor_counter/css/main.css">
    <!--===============================================================================================-->

    <div class="flex-w flex-c cd100 wsize1 bor1" style="margin-bottom: 50px;">
        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 days">35</span>
            <span class="s1-txt1">Days</span>
        </div>

        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 hours">17</span>
            <span class="s1-txt1">Hours</span>
        </div>

        <div class="flex-col-c-m size2 bg0 bor2">
            <span class="l1-txt3 p-b-7 minutes">50</span>
            <span class="s1-txt1">Minutes</span>
        </div>

        <div class="flex-col-c-m size2 bg0">
            <span class="l1-txt3 p-b-7 seconds">39</span>
            <span class="s1-txt1">Seconds</span>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/bootstrap/js/popper.js"></script>
    <script src="{{ url('') }}/vendor_counter/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/countdowntime/moment.min.js"></script>
    <script src="{{ url('') }}/vendor_counter/countdowntime/moment-timezone.min.js"></script>
    <script src="{{ url('') }}/vendor_counter/countdowntime/moment-timezone-with-data.min.js"></script>
    <script src="{{ url('') }}/vendor_counter/countdowntime/countdowntime.js"></script>
    <script>
        $('.cd100').countdown100({
            // Set Endtime here
            // Endtime must be > current time
            endtimeYear: 2025,
            endtimeMonth: 12,
            endtimeDate: -180,
            endtimeHours: 0,
            endtimeMinutes: 0,
            endtimeSeconds: 0,
            timeZone: ""
            // ex:  timeZone: "America/New_York", can be empty
            // go to " http://momentjs.com/timezone/ " to get timezone
        });

        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Silahkan Dipilih',
            allowClear: true,
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('') }}/vendor_counter/js/main.js"></script>
    <!-- End counter -->

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            function getThousandSeparator(val) {
                return Intl.NumberFormat('id-ID', {
                    maximumFractionDigits: 3
                }).format(val);
            }
            $('.number-bulat').keyup(function(e) {
                var n = $(this).val().replace(/[^\d,]/g, '');
                $(this).val(getThousandSeparator(n));
            });

            $(".date-picker").flatpickr({
                dateFormat: "d-m-Y",
            });
            $(".month-picker").flatpickr({
                dateFormat: "F Y",
            });
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
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
        })
    </script>
    @yield('page-scripts')

</body>

</html>
