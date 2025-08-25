<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <link rel="icon" href="img/logo1.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  @stack('styles')
  @yield('styles')

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    .dataTables_wrapper tbody tr.bg-warning td {
      z-index: 2 !important;
    }

    .table>:not(caption)>*>* {
      background-color: transparent;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    @include('dashboard.layouts.navbar')
    @include('dashboard.layouts.sidebar')
    <div class="content-wrapper px-4">
      @yield('content')
    </div>
    @include('dashboard.layouts.footer')
  </div>
  @stack('scripts')
  @yield('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="{{ asset('adminLTE/dist/js/adminlte.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
  <script src="{{ asset('adminLTE/plugins/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('adminLTE/dist/js/demo.js')}}"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.7.0/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sb-1.7.0/sp-2.3.0/sr-1.4.0/datatables.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.7.0/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sb-1.7.0/sp-2.3.0/sr-1.4.0/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


</body>

</html>