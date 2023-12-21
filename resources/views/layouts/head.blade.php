<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prototype</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href={{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Ionicons -->
    <link rel="stylesheet" href={{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href={{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- JQVMap -->
    <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css') }}
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome -->
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
    <!-- summernote -->
    <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.min.css') }}>
    <script src="https://cdn.tiny.cloud/1/d2nq8cur7uv9c3ovyevwee5l5e5k2ym6hodsnpuuy1hyy1yf/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>
