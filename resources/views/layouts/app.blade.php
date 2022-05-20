<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ICONS -->
    <link rel="icon" href="{{ asset('img/iot-avocado.png') }}" type="image/x-icon">
    <!-- FONTAWESOME  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" crossorigin="anonymous">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Paleta de Colors -->
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @livewireStyles

    @stack('style')

    {{-- sweetalert2 Modal --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Style Admin -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>


<body class="hold-transition skin-blue sidebar-mini">
    {{-- <x-jet-banner /> --}}

    <div class="wrapper">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->

        <div class="content-wrapper">
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- @livewire('admin.footer-admin') --}}
    </div>

    @stack('modals')

    @livewireScripts

    @isset($js)
        {{ $js }}
    @endisset

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js')}} charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>

    <!-- Select2 -->
    {{-- <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('admin/dist/js/app.min.js') }}"></script> --}}
    <script src="{{ asset('admin/dist/js/app.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script> --}}
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>


    @stack('script')

    <script>
        Livewire.on('errorSize', mensaje => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,
            }) /*  */
        });
    </script>


</body>

</html>
